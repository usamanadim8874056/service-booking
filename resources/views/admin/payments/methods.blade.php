@extends('admin.layout')
@section('title','Payment Methods')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Payment Methods @endslot
    @slot('add_btn')  @endslot
    @slot('active') Payment Methods @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($pay_methods->isNotEmpty())
                            @foreach($pay_methods as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->name}}</td>
                                    @if($row->status == '1')
                                        <td><span class="badge badge-success">Enabled</span></td>
                                        <td><button class="btn btn-danger btn-sm change-pay-method-status" data-id="{{$row->id}}" data-status="0">Disable</button></td>
                                    @else
                                        <td><span class="badge badge-danger">Disabled</span></td>
                                        <td><button class="btn btn-success btn-sm change-pay-method-status" data-id="{{$row->id}}" data-status="1">Enable</button></td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" align="center">No Record Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
</div>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
@stop