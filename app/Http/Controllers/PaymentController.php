<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use App\Models\UserWallet;
use App\Models\Wallet_Transactions;
use Yajra\DataTables\DataTables;
use Razorpay\Api\Api;
use Exception;

class PaymentController extends Controller
{
    private $client;

    public function __construct()
    {
        $paypal_conf = config('paypal');

        // Create environment based on mode
        if ($paypal_conf['settings']['mode'] === 'sandbox') {
            $environment = new SandboxEnvironment(
                $paypal_conf['client_id'],
                $paypal_conf['secret']
            );
        } else {
            $environment = new ProductionEnvironment(
                $paypal_conf['client_id'],
                $paypal_conf['secret']
            );
        }

        $this->client = new PayPalHttpClient($environment);
    }


    /**
     * Create an order and redirect user to PayPal approval page.
     * $amt can be a number or string. We'll format to two decimal places.
     */
    public function payWithpaypal($amt)
    {
        $amountToBePaid = number_format((float)$amt, 2, '.', '');

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');

        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'reference_id' => 'wallet_topup_' . time(),
                'description' => 'Wallet Top Up',
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => $amountToBePaid,
                    'breakdown' => [
                        'item_total' => [
                            'currency_code' => 'USD',
                            'value' => $amountToBePaid
                        ]
                    ]
                ],
                'items' => [[
                    'name' => 'Wallet Top Up',
                    'description' => 'Wallet Top Up',
                    'unit_amount' => [
                        'currency_code' => 'USD',
                        'value' => $amountToBePaid
                    ],
                    'quantity' => '1'
                ]]
            ]],
            'application_context' => [
                'return_url' => route('paypal-status'),
                'cancel_url' => route('paypal-status'),
                'brand_name' => config('app.name'),
                'user_action' => 'PAY_NOW'
            ]
        ];

        try {
            $response = $this->client->execute($request);

            // Get the approval URL
            $approval_url = null;
            foreach ($response->result->links as $link) {
                if ($link->rel === 'approve') {
                    $approval_url = $link->href;
                    break;
                }
            }

            // Store order ID and amount in session
            Session::put('paypal_order_id', $response->result->id);
            Session::put('amount', $amt);

            if ($approval_url) {
                return redirect($approval_url);
            }

            session()->flash('error', 'Unable to create PayPal order');
            return redirect('my-wallet');
        } catch (\Exception $ex) {
            if (config('app.debug')) {
                session()->flash('error', 'Connection timeout: ' . $ex->getMessage());
                return redirect('my-wallet');
            } else {
                session()->flash('error', 'Some error occur, sorry for inconvenient');
                return redirect('my-wallet');
            }
        }
    }

    /**
     * Handle PayPal return and capture the order
     */
    public function getPaymentStatus(Request $request)
    {
        // Get the order ID from session
        $order_id = Session::get('paypal_order_id');

        // Check if payment was cancelled
        if (empty($request->token) || !$order_id) {
            session()->flash('error', 'Payment failed or was cancelled');
            return redirect('my-wallet');
        }

        // Capture the order
        $capture_request = new OrdersCaptureRequest($order_id);

        try {
            $response = $this->client->execute($capture_request);

            // Check if payment was successful
            if ($response->result->status === 'COMPLETED') {

                // Get capture ID for reference
                $capture_id = $response->result->purchase_units[0]->payments->captures[0]->id ?? $order_id;

                $transact = new Wallet_Transactions();
                $transact->user = Session::get('user_id');
                $transact->amount = Session::get('amount');
                $transact->type = 'credit';
                $transact->add_payment_id = $capture_id;
                $transact->status = '1';
                $transact->reason = 'Wallet Top Up';
                $save = $transact->save();

                $update = UserWallet::where('user', Session::get('user_id'))
                    ->increment('balance', Session::get('amount'));

                Session::forget('paypal_order_id');
                Session::forget('amount');

                session()->flash('success', 'Payment Successfully Added to your Wallet');
                return redirect('my-wallet');
            }

            session()->flash('error', 'Payment not completed. Status: ' . $response->result->status);
            return redirect('my-wallet');
        } catch (\Exception $ex) {
            session()->flash('error', 'Payment capture failed: ' . $ex->getMessage());
            return redirect('my-wallet');
        }
    }

    public function payWithRazorpay($amt, $pay_id)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($pay_id);

        if (!empty($pay_id)) {
            try {
                $response = $api->payment->fetch($pay_id)->capture(array('amount' => $payment['amount']));

                $transact = new Wallet_Transactions();
                $transact->user = Session::get('user_id');
                $transact->amount = $amt;
                $transact->type = 'credit';
                $transact->add_payment_id = $pay_id;
                $transact->status = '1';
                $transact->reason = 'Wallet Top Up';
                $save = $transact->save();

                $update = UserWallet::where('user', Session::get('user_id'))->increment('balance', $amt);

                session()->flash('success', 'Payment Successfully Added to your Wallet');
                return redirect('my-wallet');
            } catch (Exception $e) {
                Session::flash('error', $e->getMessage());
                return redirect('my-wallet');
            }
        }
    }

    public function transactions(Request $request)
    {
        if ($request->input()) {
            $data = Wallet_Transactions::select(['wallet_transactions.*', 'users.user_name'])
                ->leftJoin('users', 'users.user_id', '=', 'wallet_transactions.user')
                ->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == '1') {
                        $status = '<span class="btn btn-xs btn-success">Completed</span>';
                    } elseif ($row->status == '0') {
                        $status = '<span class="btn btn-xs btn-warning">Pending</span>';
                    }
                    return $status;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == "0") {
                        $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-status="1" class="btn btn-success btn-sm complete-payout-request">Approve</a> <a href="javascript:void(0)" data-id="' . $row->id . '" data-status="-1" class="btn btn-danger btn-sm complete-payout-request">Reject</a>';
                    } else {
                        $btn = '';
                    }
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.payments.transactions');
    }

    public function payment_methods(Request $request)
    {
        if ($request->input()) {
            $update = DB::table('payment_methods')->where('id', $request->id)->update([
                'status' => $request->status
            ]);
            return $update;
        } else {
            $pay_methods = DB::table('payment_methods')->get();
            return view('admin.payments.methods', ['pay_methods' => $pay_methods]);
        }
    }
}
