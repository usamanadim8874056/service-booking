@extends('admin.layout')
@section('title','Edit Page')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Page'=>'admin/page']])
    @slot('title') Edit Page @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Page @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="EditPage"  method="POST">
            @csrf
            {{ method_field('PUT') }}
            @if($page)
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/pages/'.$page->page_id)}}" >
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pages Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group mb-4">
                                        <label>Page Title</label>
                                        <input type="text" class="form-control" name="page_title" value="{{$page->page_title}}" placeholder="Enter Page Title Name">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group mb-4">
                                        <label>Page Slug</label>
                                        <input type="text" class="form-control" name="page_slug" value="{{$page->page_slug}}" placeholder="Enter Page Title Slug Name">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group mb-4">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected disabled>Select Status</option>    
                                            <option value="1"  {{ ($page->status == "1" ? "selected":"") }} >Active</option>
                                            <option value="0"  {{ ($page->status == "0" ? "selected":"") }} >Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group mb-4">
                                        <label>Page Content</label>
                                        <textarea  class="textarea" class="form-control" name="page_content" placeholder="Place some text here" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!htmlspecialchars_decode($page->page_content)!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            @endif
        </form> <!-- /.form start -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
</div>
@stop