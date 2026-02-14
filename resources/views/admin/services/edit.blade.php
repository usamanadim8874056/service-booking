@extends('admin.layout')
@section('title','Edit Service')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Service'=>'admin/services']])
    @slot('title') Edit Service @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Service @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="EditService"  method="POST">
            @csrf
            {{ method_field('PUT') }}
            @if($service)
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/services/'.$service->service_id)}}" >
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Services Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-2">Image <small class="text-danger">*</small></label>
                                <div class="custom-file col-md-7">
                                    <input type="hidden" class="custom-file-input" name="old_img" value="{{$service->image}}" />
                                    <input type="file" class="custom-file-input" name="img" onChange="readURL(this);">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="col-md-3 text-right">
                                    @if($service->image != '')
                                    <img id="image" src="{{asset('public/services/'.$service->image)}}" alt=""  height="80px">
                                    @else
                                    <img id="image" src="{{asset('public/services/default.jpg')}}" alt=""  height="80px">
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Service</label>
                                        <input type="text" class="form-control" name="service" value="{{$service->service_name}}" placeholder="Enter Service Name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Service Slug</label>
                                        <input type="text" class="form-control" name="service_slug" value="{{$service->service_slug}}" placeholder="Enter Service Slug">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Category<small class="text-danger">*</small></label>
                                        <select class="form-control" name="category">
                                            <option disabled selected value="" >Select The Category</option>
                                            @if(!empty($category))
                                                @foreach($category as $types)
                                                    @if($service->category == $types->cat_id)
                                                        <option value="{{$types->cat_id}}" selected>{{$types->category_name}}</option>
                                                        @else
                                                        <option value="{{$types->cat_id}}">{{$types->category_name}}</option>
                                                    @endif
                                                @endforeach
                                            @endif 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected disabled>Select Status</option>    
                                            <option value="1"  {{ ($service->status == "1" ? "selected":"") }} >Active</option>
                                            <option value="0"  {{ ($service->status == "0" ? "selected":"") }} >Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group mb-4">
                                        <label>Service Description</label>
                                        <textarea  class="form-control" name="service_description" placeholder="Place some text here">{!!htmlspecialchars_decode($service->service_description)!!}</textarea>
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
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            @endif
        </form> <!-- /.form start -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
</div>
@stop