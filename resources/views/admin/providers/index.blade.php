@extends('admin.layout')
@section('title','Providers')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Providers @endslot
        @slot('add_btn')@endslot
        @slot('active') Providers @endslot
    @endcomponent
    <!-- /.content-header -->
    <!-- show data table component -->
    @component('admin.components.data-table',['thead'=>
        ['S NO.','Name','Email','Phone','Joined On','Status','Action']
    ])
        @slot('table_id') provider-list @endslot
    @endcomponent
</div>
@stop

@section('pageJsScripts')
<!-- DataTables -->
<script src="{{asset('public/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#provider-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "providers",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'user_name', name: 'name'},
            {data: 'user_email', name: 'email'},
            {data: 'user_phone', name: 'phone'},
            {data: 'created_at', name: 'join_date'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });
</script>
@stop