<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\City;
use App\Models\Service;
use App\Models\Availability;
use App\Models\Booking;
use App\Models\UserWallet;
use App\Models\Wallet_Transactions;
use Yajra\DataTables\DataTables;
// use Razorpay\Api\Api;
// use Exception;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = User::where('user_type', 'user')->orderBy('user_id', 'desc')->get();
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
                        $btn = '<a href="javascript:void(0)"data-id="' . $row->user_id . '"  data-status="' . $row->status . '" data-user="user" class="block-user btn btn-warning btn-sm">Block</a> ';
                    } else {
                        $btn = '<a href="javascript:void(0)"data-id="' . $row->user_id . '"  data-status="' . $row->status . '" data-user="user" class="block-user btn btn-success btn-sm">Unblock </a> ';
                    }
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.users.index');
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
            return view('public.signup');
        }
    }

    // public function provider_signup()
    // {

    //     return view('public.provider-signup');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'user_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,user_email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->user_name = $request->input("user_name");
        $user->user_phone = $request->input("phone");
        $user->user_email  = $request->input("email");
        $user->user_password  = Hash::make($request->input("password"));
        $user->user_type  = $request->input("type");
        $result =  $user->save();
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (session()->get('user_id')) {
            $value = session()->get('user_id');

            $user = User::where(['user_id' => $value])->first();
            $cities = City::all();

            return view('public.profile', ['user' => $user, 'cities' => $cities]);
        } else {
            return redirect('/login');
        }
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
    public function update(Request $request)
    {
        // return $request->input();

        $id = session()->get('user_id');
        $request->validate([
            'user_name' => 'required',
            'user_phone' => 'required',
        ]);
        $address = '';
        if ($request->user_address) {
            $address = $request->user_address;
        }
        $city = '';
        if ($request->user_city) {
            $city = $request->user_city;
        }

        // Update Provider Image
        if ($request->user_image != '') {
            $path = public_path() . '/users/';
            //code for remove old file
            if ($request->old_img != ''  && $request->old_img != null) {
                $file_old = $path . $request->old_img;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            //upload new file
            $file = $request->user_image;
            $image = time() . $request->user_image->getClientOriginalName();
            $file->move($path, $image);
        } else {
            $image = $request->old_img;
        }

        $user = User::where(['user_id' => $id])->update([
            "user_name" => $request->input('user_name'),
            "user_image" => $image,
            "user_phone" => $request->input('user_phone'),
            "user_address" => $address,
            "user_city" => $city,
        ]);
        return $user;
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

    public function login(Request $req)
    {
        // if(!Session::has('user_id')){
        if ($req->input()) {
            $req->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = $req->input('email');
            $pass = $req->input('password');

            $login = User::select(['user_id', 'user_name', 'user_email', 'user_password', 'user_type'])
                ->where('user_email', $user)
                ->first();
            if ($login) {
                // return $login['user_id'];
                if (Hash::check($pass, $login['user_password'])) {
                    $req->session()->put('user_id', $login['user_id']);
                    $req->session()->put('user_name', $login['user_name']);
                    $req->session()->put('user_type', $login['user_type']);
                    return '1';
                } else {
                    return 'Email Address and Password Not Matched.';
                }
            } else {
                return 'Email Does Not Exists';
            }
        } else {
            return view('public.login');
        }
        // }else{
        //     return redirect('dashboard');
        // }
    }


    public function change_password(Request $request)
    {
        if ($request->input()) {
            $request->validate([
                'password' => 'required',
                'new_pass' => 'required',
                'new_confirm' => 'required'
            ]);
            $id = session()->get('user_id');
            $select = DB::table('users')->where('user_id', $id)->pluck('user_password');

            if (Hash::check($request->password, $select[0])) {
                $update = DB::table('users')->where('user_id', $id)->update([
                    'user_password' => Hash::make($request->new_pass)
                ]);
                return 1;
            } else {
                return 'Please Enter Correct Old Password';
            }
        } else {
            return view('public.change-password');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->forget('first_name');
        return redirect('/');
    }

    public function userChangeStatus(Request $request)
    {
        $status = $request->status;
        if ($status == "1") {
            $status = "0";
        } else {
            $status = "1";
        }
        $users = User::where(['user_id' => $request->id])->update([
            "status" => $status,
        ]);
        return $users;
    }

    public function dashboard()
    {
        if (session()->has('user_id')) {
            $id = session()->get('user_id');
            $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $id])->first();
            if (session()->get('user_type') == 'user') {
                $bookings_count = Booking::where('user', $id)->count();
                $services = 0;
            } else {
                $bookings_count = Booking::where('provider', $id)->count();
                $services = Service::where('provider', $id)->count();
            }
            // return $bookings_count;
            return view('public.dashboard', ['user' => $user, 'services' => $services, 'bookings_count' => $bookings_count]);
        } else {
            return redirect('/login');
        }
    }

    public function add_service()
    {
        if (session()->has('user_id')) {
            $id = session()->get('user_id');
            $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $id])->first();
            $categories = Category::where('status', '1')->get();
            $cities = City::All();
            return view('public.add-service', ['user' => $user, 'categories' => $categories, 'cities' => $cities]);
        } else {
            return redirect('/login');
        }
    }





    public function user_bookings()
    {
        if (session()->get('user_id') && session()->get('user_type') == 'user') {
            $id = session()->get('user_id');
            // return $id;
            $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $id])->first();
            $bookings = Booking::select(['bookings.*', 'services.service_name', 'services.service_images', 'services.service_amount', 'users.user_name', 'users.user_phone', 'cities.city_name'])
                ->leftJoin('services', 'services.service_id', '=', 'bookings.service')
                ->leftJoin('users', 'users.user_id', '=', 'bookings.provider')
                ->leftJoin('cities', 'cities.city_id', '=', 'bookings.location')
                ->where('bookings.user', $id)
                ->get();
            // return $bookings;
            return view('public.my-bookings', ['user' => $user, 'bookings' => $bookings]);
        } else {
            return redirect('login');
        }
    }

    public function my_wallet()
    {
        $id = session()->get('user_id');
        $wallet = UserWallet::where('user', $id)->first();
        if (!$wallet) {
            $insert = new UserWallet();
            $insert->user = $id;
            $result = $insert->save();
            $wallet = UserWallet::where('user', $id)->first();
        }
        $transactions = Wallet_Transactions::where('user', $id)->orderBy('id', 'DESC')->get();
        $pay_methods = DB::table('payment_methods')->where('status', '1')->pluck('name')->toArray();
        $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $id])->first();
        return view('public.my-wallet', ['user' => $user, 'wallet' => $wallet, 'transactions' => $transactions, 'pay_methods' => $pay_methods]);
    }
}
