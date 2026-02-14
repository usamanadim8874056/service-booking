@extends('admin.layout')
@section('title','Contact Queries')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Contact Queries @endslot
        @slot('add_btn')  @endslot
        @slot('active') Contact Queries @endslot
    @endcomponent
    <!-- /.content-header -->
    
    <!-- show data table component -->
    @component('admin.components.data-table',['thead'=>
        ['S NO.','Name','Email','Phone','Message','Date']
    ])
        @slot('table_id') contact-list @endslot
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
    var table = $("#contact-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "contact-queries",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'user_name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'description', name: 'message'},
            {data: 'created_at', name: 'date'},
        ]
    });
</script>
@stop