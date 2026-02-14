@extends('admin.layout')
@section('title','Commission')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Commission @endslot
        @slot('add_btn') @endslot
        @slot('active') Commission @endslot
    @endcomponent
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- form start -->
            <form class="form-horizontal" id="updateCommission" method="POST">
            {{ csrf_field() }}
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Commission Settings</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group mb-4">
                                            <label>Type</label>
                                            <select name="type" class="form-control">
                                                <option value="percentage" {{($data->type == 'percentage') ? 'selected' : '';}}>Percentage</option>
                                                <option value="fixed" {{($data->type == 'fixed') ? 'selected' : '';}}>Fixed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group mb-4">
                                            <label>Value</label>
                                            <input type="text" class="form-control" name="value" value="{{$data->value}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group mb-4">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{($data->status == '1') ? 'selected' : '';}}>Active</option>
                                                <option value="0" {{($data->status == '0') ? 'selected' : '';}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <input type="submit" class="btn btn-primary" value="Update"/>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form> <!-- /.form start -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop