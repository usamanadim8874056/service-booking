<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Booking;
use App\Models\Service;
use App\Models\UserWallet;
use App\Models\GeneralSetting;
use App\Models\User_Transactions;
use App\Models\Wallet_Transactions;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\DataTables;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $data = Booking::select(['bookings.*','services.service_name','users.user_name','p.user_name as provider_name'])
        // ->LeftJoin('services','services.service_id','=','bookings.service')
        // ->LeftJoin('users','users.user_id','=','bookings.user')
        // ->LeftJoin('users as p','p.user_id','=','bookings.provider')
        // ->orderBy('bookings.id','desc')->get();
        if ($request->ajax()) {
            $data = Booking::select(['bookings.*', 'services.service_name', 'users.user_name', 'p.user_name as provider_name'])
                ->leftJoin('services', 'services.service_id', '=', 'bookings.service')
                ->leftJoin('users', 'users.user_id', '=', 'bookings.user')
                ->leftJoin('users as p', 'p.user_id', '=', 'bookings.provider')
                ->orderBy('bookings.id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('booking_id', function ($row) {
                    return 'BKG00' . $row->id;
                })
                ->editColumn('date', function ($row) {
                    return date('d M, Y', strtotime($row->date));
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == '0') {
                        $st = '<span class="badge badge-warning">Pending</span>';
                    } elseif ($row->status == '1') {
                        $st = '<span class="badge badge-success">Accepted</span>';
                    } else {
                        $st = '<span class="badge badge-danger">Rejected</span>';
                    }
                    return $st;
                })

                //  ->addColumn('action', function($row){
                //      $btn = '<a href="services/'.$row->service_id.'/edit" class="btn btn-info btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-service btn btn-danger btn-sm" data-id="'.$row->service_id.'">Delete</a>';
                //      return $btn;
                //  })
                ->rawColumns(['status'])
                ->make(true);
        }
        return view('admin.bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $category = Category::all();
        // return view('admin.services.create',['category'=> $category]);
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
        // return $request->input();
        // $auto_approve = DB::table('general_settings')->select('auto_approve_service')->first();
        // return $auto_approve->auto_approve_service;
        // $request->validate([
        //     's_title'=>'required',
        //     's_cat'=>'required',
        //     's_amount'=>'required',
        //     's_location'=>'required',
        //     's_desc'=>'required',
        //     'gallery'=>'required',
        // ]);

        // if($request->img){
        //     $image = $request->img->getClientOriginalName();
        //     $request->img->move(public_path('services'),$image);
        // }else {
        //     $image = "";
        // }

        // $gallery = [];
        // if($request->hasfile('gallery'))
        //  {
        //     foreach($request->file('gallery') as $file)
        //     {
        //         $name = time().rand(1,100).'.'.$file->extension();
        //         $file->move(public_path('services'), $name);
        //         $gallery[] = $name;
        //     }
        //  }

        //    $service = new Service();
        //    $service->service_name = $request->input("s_title");
        //    $service->service_slug =str_replace(' ','-',strtolower($request->input('s_title')));
        //    $service->service_description = htmlspecialchars($request->input("s_desc"));
        //    $service->service_images = implode(',',$gallery);
        //    $service->service_amount = $request->input("s_amount");
        //    $service->category = $request->input("s_cat");
        //    $service->location = $request->input("s_location");
        //    $service->provider = session()->get('user_id');
        //    $service->status = $auto_approve->auto_approve_service;
        //    $result = $service->save();
        //    return $result;
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
        // $category = Category::where('status','1')->get();
        // $cities = City::all();
        // $service = Service::where(['service_id'=>$id])->first();
        // return $service;
        // $user_id = session()->get('user_id');
        // $user = User::select('user_name','user_image','created_at')->where(['user_id'=> $user_id])->first();
        // return $user;
        // return view('public.edit-service',['service'=>$service,'categories'=> $category,'cities'=>$cities,'user'=>$user]);
        // return view('admin.services.edit',['service'=>$service,'category'=> $category]);
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
        // $request->validate([
        //     's_title'=>'required',
        //     's_cat'=>'required',
        //     's_amount'=>'required',
        //     's_location'=>'required',
        //     's_desc'=>'required',
        //     'gallery1'=>'required',
        // ]);

        // $gallery = array_filter(explode(',',$request->old_images));
        // return $gallery;
        // if(!empty($request->old)){
        //     for($j=0;$j<count($gallery);$j++){
        //         if(!in_array($j+1,$request->old)){
        //             $img = $gallery[$j];
        //             if(file_exists(public_path('services/'.$img))){
        //                     unlink(public_path('services/').$img);
        //             }
        //             unset($gallery[$j]);
        //         }
        //     }
        // }
        // if($request->hasfile('gallery1'))
        //  {
        //     foreach($request->file('gallery1') as $file)
        //     {
        //         $name = time().rand(1,100).'.'.$file->extension();
        //         $file->move(public_path('services'), $name);
        //         $gallery[] = $name;
        //     }
        //  }

        // return $gallery;
        // $service = Service::where(['service_id'=>$request->id])->update([
        //     "service_images" =>implode(',',$gallery),
        //     "service_name" => $request->input("s_title"),
        //     "service_slug"=>str_replace(' ','-',strtolower($request->input('s_title'))),
        //     "service_amount"=>$request->input('s_amount'),
        //     "location"=>$request->input('s_location'),
        //     "category" => $request->input("s_cat"),
        //     "service_description" => htmlspecialchars($request->input("s_desc")),
        // ]);
        // return $service;
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
        // $destroy = Service::where('service_id',$id)->delete();
        // return  $destroy;
    }

    // public function change_status(Request $request){
    //     $update = Service::where('service_id',$request->id)->update([
    //         'status'=>$request->service_status
    //     ]);
    //     return $update;
    // }

    // public function approve(Request $request){
    // //    $id = $request->id;

    //    $update = Service::where('service_id',$request->id)->update([
    //         'approved'=>1
    //     ]);
    //     return $update;
    // }


    public function reject_provider_booking(Request $request)
    {
        $id = $request->id;
        $update = Booking::where('id', $id)->update([
            'status' => '-1'
        ]);
        return $update;
    }

    public function accept_booking(Request $request)
    {
        $id = $request->id;
        $update = Booking::where('id', $id)->update([
            'status' => '1'
        ]);
        return $update;
    }

    public function cancel_booking(Request $request)
    {
        $id = $request->id;
        if ($request->user == 'user') {
            $update = Booking::where('id', $id)->update([
                'user_status' => '-1',
                'status' => '-2'
            ]);
        } else {
            $update = Booking::where('id', $id)->update([
                'provider_status' => '-1',
                'status' => '-2'
            ]);
        }
        return $update;
    }

    public function complete_booking(Request $request)
    {
        $id = $request->id;
        $user = Session::get('user_id');
        if ($request->user == 'user') {
            $update = Booking::where('id', $id)->update([
                'user_status' => '1',
            ]);
        } else {
            $update = Booking::where('id', $id)->update([
                'provider_status' => '1',
            ]);
        }

        $booking = Booking::where('id', $id)->first();
        if ($booking->provider_status == '1' && $booking->user_status == '1') {
            $amount = Service::where('service_id', $booking->service)->pluck('service_amount')->first();
            $commission = DB::table('commission')->select('*')->get();
            foreach ($commission as $com) {
                if ($com->type == 'percentage') {
                    $new_amount = $amount - ($amount * $com->value / 100);
                } else {
                    $new_amount = $amount - $com->value;
                }
            }
            $decrement = UserWallet::where('user', $booking->user)->decrement('balance', $amount);
            $increment = UserWallet::where('user', $booking->provider)->increment('balance', $new_amount);
            $data = [
                ['user' => $booking->user, 'amount' => $amount, 'type' => 'debit', 'status' => '1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['user' => $booking->provider, 'amount' => $new_amount, 'type' => 'credit', 'status' => '1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ];
            $transact = Wallet_Transactions::insert($data);
        }

        return $update;
    }
}
