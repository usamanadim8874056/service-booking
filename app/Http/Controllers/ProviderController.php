<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Category;
use App\Models\City;
use App\Models\Service;
use App\Models\Availability;
use App\Models\Booking;
use App\Models\PayoutRequest;
use App\Models\UserWallet;
use App\Models\GeneralSetting;
use App\Models\Wallet_Transactions;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('user_type', 'provider')->orderBy('user_id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == '1') {
                        $status = '<span class="btn btn-xs btn-success">Active</span>';
                    } else {
                        $status = '<span class="btn btn-xs btn-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == "1") {
                        $btn = '<a href="javascript:void(0)"data-id="' . $row->user_id . '"  data-status="' . $row->status . '" data-user="provider" class="block-user btn btn-warning btn-sm">Block</a> ';
                    } else {
                        $btn = '<a href="javascript:void(0)"data-id="' . $row->user_id . '"  data-status="' . $row->status . '" data-user="provider" class="block-user btn btn-success btn-sm">Unblock </a> ';
                    }
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.providers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Session::has('user_id')) {
            return redirect('dashboard');
        } else {
            return view('public.provider-signup');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_service()
    {
        if (session()->has('user_id')) {
            $id = session()->get('user_id');
            $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $id])->first();
            $categories = Category::where('status', '1')->get();
            $cities = City::all();
            $commission = DB::table('commission')->first();
            $cur_format = GeneralSetting::pluck('cur_format')->first();
            return view('public.add-service', ['user' => $user, 'categories' => $categories, 'cities' => $cities, 'commission' => $commission, 'cur_format' => $cur_format]);
        } else {
            return redirect('/login');
        }
    }

    public function my_services()
    {
        if (session()->has('user_id')) {
            $id = session()->get('user_id');
            $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $id])->first();
            $services = Service::select('services.*', 'categories.category_name', 'categories.category_slug')->leftJoin('categories', 'categories.cat_id', '=', 'services.category')->where('provider', $id)->get();
            return view('public.my-services', ['user' => $user, 'services' => $services]);
        } else {
            return redirect('/login');
        }
    }

    public function provider_bookings()
    {
        if (session()->get('user_id') && session()->get('user_type') == 'provider') {
            $id = session()->get('user_id');
            // return $id;
            $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $id])->first();
            $bookings = Booking::select(['bookings.*', 'services.service_name', 'services.service_images', 'services.service_amount', 'users.user_name', 'users.user_phone', 'cities.city_name'])
                ->leftJoin('services', 'services.service_id', '=', 'bookings.service')
                ->leftJoin('users', 'users.user_id', '=', 'bookings.user')
                ->leftJoin('cities', 'cities.city_id', '=', 'bookings.location')
                ->where('bookings.provider', $id)
                ->get();
            // return $bookings;
            return view('public.my-bookings', ['user' => $user, 'bookings' => $bookings]);
        } else {
            return redirect('login');
        }
    }

    public function availability(Request $request)
    {
        if (session()->has('user_id') && session()->get('user_type') == 'provider') {
            $id = session()->get('user_id');
            if ($request->input()) {
                // return $request->input();
                $destroy = Availability::where('provider', $id)->delete();

                if ($request->days == 'all') {
                    for ($i = 1; $i <= 7; $i++) {
                        $availability = new Availability();
                        $availability->provider = $id;
                        $availability->day = $i;
                        $availability->from_time = $request->from_time;
                        $availability->to_time = $request->to_time;
                        $result = $availability->save();
                    }
                    return $result;
                } else {
                    for ($i = 0; $i < count($request->days); $i++) {
                        $availability = new Availability();
                        $availability->provider = $id;
                        $availability->day = $request->days[$i];
                        $availability->from_time = $request->from_time[$i];
                        $availability->to_time = $request->to_time[$i];
                        $result = $availability->save();
                    }
                    return $result;
                }
            } else {
                $availability = Availability::where('provider', $id)->get();
                // return $availability;
                $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $id])->first();
                // return $user;
                return view('public.availability', ['user' => $user, 'availability' => $availability]);
            }
        } else {
            return redirect('login');
        }
    }

    public function payout_settings(Request $request)
    {
        $id = session()->get('user_id');
        if ($request->input()) {
            $request->validate([
                'account_no' => 'required',
                'bank_name' => 'required',
            ]);
            if ($request->pay_id) {

                $update = DB::table('payout_settings')->where('id', $request->pay_id)->update([
                    'bank_name' => $request->bank_name,
                    'account_no' => $request->account_no,
                    'iban' => $request->iban,
                    'bank_address' => $request->bank_address,
                ]);

                return $update;
            } else {
                $insert = DB::table('payout_settings')->insert([
                    'user' => $request->user,
                    'bank_name' => $request->bank_name,
                    'account_no' => $request->account_no,
                    'iban' => $request->iban,
                    'bank_address' => $request->bank_address,
                ]);

                return $insert;
            }
        } else {
            $pay_settings = DB::table('payout_settings')->where('user', $id)->first();
            $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $id])->first();
            return view('public.payout-settings', ['user' => $user, 'pay_settings' => $pay_settings]);
        }
    }

    public function payouts(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('payout_request')->select(['payout_request.*', 'users.user_name'])
                ->leftJoin('users', 'users.user_id', '=', 'payout_request.user')
                ->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == '1') {
                        $status = '<span class="btn btn-xs btn-success">Completed</span>';
                    } elseif ($row->status == '0') {
                        $status = '<span class="btn btn-xs btn-warning">Pending</span>';
                    } else {
                        $status = '<span class="btn btn-xs btn-danger">Rejected</span>';
                    }
                    return $status;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->editColumn('completed_on', function ($row) {
                    if ($row->completed_on != '') {
                        $dt = date('d M, Y', strtotime($row->completed_on));
                    } else {
                        $dt = '';
                    }
                    return $dt;
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
        return view('admin.providers.payouts');
    }

    public function complete_payout_request(Request $request)
    {

        $update = PayoutRequest::where('id', $request->id)->update([
            'status' => $request->status,
            'completed_on' => date('Y-m-d')
        ]);
        $pay = PayoutRequest::where('id', $request->id)->first();
        if ($request->status == '1') {
            $wallet = UserWallet::where('user', $pay->user)->decrement('balance', $pay->amount);
            $transact = new Wallet_Transactions();
            $transact->user = $pay->user;
            $transact->amount = $pay->amount;
            $transact->type = 'debit';
            $transact->status = 1;
            $transact->reason = 'Wallet Payout';
            $transact->save();
        }
        return $update;
    }





    public function withdraw_payment_wallet(Request $request)
    {

        $wallet = UserWallet::where('user', $request->user)->pluck('balance')->first();
        if ($wallet && $wallet >= $request->amount) {
            $insert = new PayoutRequest();
            $insert->user = $request->user;
            $insert->amount = $request->amount;
            $result = $insert->save();
            return $result;
        } else {
            return 'Amount Exceeded from Wallet Balance.';
        }
    }

    public function payout_requests()
    {
        $id = session()->get('user_id');
        $payout_requests = DB::table('payout_request')->orderBy('id', 'desc')->get();
        $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $id])->first();
        $payout_settings = DB::table('payout_settings')->where('user', $id)->first();
        return view('public.payout-requests', ['user' => $user, 'payout_requests' => $payout_requests, 'payout_settings' => $payout_settings]);
    }
}
