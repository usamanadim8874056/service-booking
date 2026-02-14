<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\DataTables;

class ServiceController extends Controller
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
            $cur_format = DB::table('general_settings')->select('cur_format')->first();
            $data = Service::select(['services.*', 'categories.category_name as category', 'users.user_name'])
                ->leftJoin('categories', 'services.category', '=', 'categories.cat_id')
                ->leftJoin('users', 'users.user_id', '=', 'services.provider')
                ->orderBy('services.service_id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    if ($row->service_images != '') {
                        $images = array_filter(explode(',', $row->service_images));
                        $img = '<img src="' . asset("public/services/" . $images['0']) . '" width="50px"> ' . $row->service_name;
                    } else {
                        $img = '<img src="' . asset("public/services/default.jpg") . '" width="50px"> ' . $row->service_name;
                    }
                    return $img;
                })
                ->editColumn('action', function ($row) {
                    if ($row->approved  == '1') {
                        $btn = '<button class="btn btn-danger btn-sm approve-service" data-id="' . $row->service_id . '" data-status="0">Hide</button>';
                    } else {
                        $btn = '<button class="btn btn-success btn-sm approve-service" data-id="' . $row->service_id . '" data-status="1">Approve</button>';
                    }
                    return $btn;
                })
                ->editColumn('service_amount', function ($row) use ($cur_format) {
                    return $cur_format->cur_format . $row->service_amount;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->editColumn('approved', function ($row) {
                    if ($row->approved == '1') {
                        $approved = '<span class="text-success">Approved</span>';
                    } else {
                        $approved = '<span class="text-primary">Not Approved</span>';
                    }
                    return $approved;
                })
                ->rawColumns(['image', 'action', 'approved'])
                ->make(true);
        }
        return view('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::all();
        return view('admin.services.create', ['category' => $category]);
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
        $auto_approve = DB::table('general_settings')->pluck('auto_approve_service')->first();
        // return $auto_approve->auto_approve_service;
        $request->validate([
            's_title' => 'required',
            's_cat' => 'required',
            's_amount' => 'required',
            's_location' => 'required',
            's_start_time' => 'required',
            's_end_time' => 'required',
            's_desc' => 'required',
            'gallery' => 'required',
        ]);


        $gallery = [];
        if ($request->hasfile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('services'), $name);
                $gallery[] = $name;
            }
        }

        $service = new Service();
        $service->service_name = $request->input("s_title");
        $service->service_slug = str_replace(' ', '-', strtolower($request->input('s_title')));
        $service->service_description = htmlspecialchars($request->input("s_desc"));
        $service->service_images = implode(',', $gallery);
        $service->service_amount = $request->input("s_amount");
        $service->category = $request->input("s_cat");
        $service->service_start_time = $request->input("s_start_time");
        $service->service_end_time = $request->input("s_end_time");
        $service->location = $request->input("s_location");
        $service->provider = session()->get('user_id');
        $service->approved = $auto_approve;
        $result = $service->save();
        return $result;
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
        $category = Category::where('status', '1')->get();
        $cities = City::all();
        $service = Service::where(['service_id' => $id])->first();
        // return $service;
        $user_id = session()->get('user_id');
        $user = User::select('user_name', 'user_image', 'created_at')->where(['user_id' => $user_id])->first();
        // return $user;
        return view('public.edit-service', ['service' => $service, 'categories' => $category, 'cities' => $cities, 'user' => $user]);
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
        $request->validate([
            's_title' => 'required',
            's_cat' => 'required',
            's_amount' => 'required',
            's_start_time' => 'required',
            's_end_time' => 'required',
            's_location' => 'required',
            's_desc' => 'required',
            'gallery1' => 'required',
        ]);

        $gallery = array_filter(explode(',', $request->old_images));
        // return $gallery;
        if (!empty($request->old)) {
            for ($j = 0; $j < count($gallery); $j++) {
                if (!in_array($j + 1, $request->old)) {
                    $img = $gallery[$j];
                    if (file_exists(public_path('services/' . $img))) {
                        unlink(public_path('services/') . $img);
                    }
                    unset($gallery[$j]);
                }
            }
        }
        if ($request->hasfile('gallery1')) {
            foreach ($request->file('gallery1') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('services'), $name);
                $gallery[] = $name;
            }
        }
        // return $gallery;
        $service = Service::where(['service_id' => $request->id])->update([
            "service_images" => implode(',', $gallery),
            "service_name" => $request->input("s_title"),
            "service_slug" => str_replace(' ', '-', strtolower($request->input('s_title'))),
            "service_amount" => $request->input('s_amount'),
            "service_start_time" => $request->input('s_start_time'),
            "service_end_time" => $request->input('s_end_time'),
            "location" => $request->input('s_location'),
            "category" => $request->input("s_cat"),
            "service_description" => htmlspecialchars($request->input("s_desc")),
        ]);
        return $service;
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
        $destroy = Service::where('service_id', $id)->delete();
        return  $destroy;
    }

    public function change_status(Request $request)
    {
        $update = Service::where('service_id', $request->id)->update([
            'status' => $request->service_status
        ]);
        return $update;
    }

    public function approve(Request $request)
    {
        //    $id = $request->id;

        $update = Service::where('service_id', $request->id)->update([
            'approved' => $request->status
        ]);
        return $update;
    }
}
