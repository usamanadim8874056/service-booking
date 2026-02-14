<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class CategoryController extends Controller
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
            $data = Category::orderBy('cat_id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    if ($row->image != '') {
                        $img = '<img src="' . asset("public/category/" . $row->image) . '" width="70px">';
                    } else {
                        $img = '<img src="' . asset("public/category/default.jpg") . '" width="70px">';
                    }
                    return $img;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == '1') {
                        $status = '<span class="btn btn-xs btn-primary">Active</span>';
                    } else {
                        $status = '<span class="btn btn-xs btn-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->cat_id . '" class="edit_category btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-category btn btn-danger btn-sm" data-id="' . $row->cat_id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $request->validate([
            'category' => 'required|unique:categories,category_name',
            //'img'=>'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->img) {
            $image = $request->img->getClientOriginalName();
            $request->img->move(public_path('category'), $image);
        } else {
            $image = "";
        }

        $category = new Category();
        $category->category_name = $request->input("category");
        $category->category_slug = str_replace(' ', '-', strtolower($request->input('category')));
        $category->image = $image;
        $result =  $category->save();
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
        $category = Category::where('cat_id', $id)->first();
        return VIEW::make('admin.category.edit', ['category' => $category]);
        // return $category;
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
        $request->validate([
            'category' => 'required|unique:categories,category_name,' . $id . ',cat_id',
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required',
        ]);

        // Update Service Image
        if ($request->img != '') {
            $path = public_path() . '/category/';
            //code for remove old file
            if ($request->old_img != ''  && $request->old_img != null) {
                $file_old = $path . $request->old_img;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            //upload new file
            $file = $request->img;
            $image = $request->img->getClientOriginalName();
            $file->move($path, $image);
        } else {
            $image = $request->old_img;
        }

        $category = Category::where(['cat_id' => $id])->update([
            "category_name" => $request->input('category'),
            "category_slug" => str_replace(' ', '-', strtolower($request->input('category_slug'))),
            "image" => $image,
            "status" => $request->input("status"),
        ]);
        return '1';
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
        $destroy = Category::where('cat_id', $id)->delete();
        return  $destroy;
    }
}
