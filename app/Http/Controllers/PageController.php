<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class PageController extends Controller
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
            $data = Page::orderBy('page_id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == '1') {
                        $status = '<span class="btn btn-xs btn-primary">Active</span>';
                    } else {
                        $status = '<span class="btn btn-xs btn-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="pages/' . $row->page_id . '/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-page btn btn-danger btn-sm" data-id="' . $row->page_id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.create');
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
            'page_title' => 'required|unique:pages,page_title',
            'page_content' => 'required',
        ]);

        $page = new Page();
        $page->page_title = $request->input("page_title");
        $page->page_slug = str_replace(' ', '-', strtolower($request->input('page_title')));
        $page->page_content = $request->input("page_content");
        $result = $page->save();
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
        $page = Page::where(['page_id' => $id])->first();
        return view('admin.pages.edit', ['page' => $page]);
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
            'page_title' => 'required|unique:pages,page_title,' . $id . ',page_id',
            'page_slug' => 'required',
            'page_content' => 'required',
            'status' => 'required',
        ]);

        $page = Page::where(['page_id' => $id])->update([
            "page_title" => $request->input("page_title"),
            "page_slug" => str_replace(' ', '-', strtolower($request->input('page_slug'))),
            "page_content" => htmlspecialchars($request->input("page_content")),
            "status" => $request->input("status"),
        ]);
        return $page;
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
        $destroy = Page::where('page_id', $id)->delete();
        return  $destroy;
    }
}
