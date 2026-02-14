@extends('admin.layout')
@section('title','Service')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Services @endslot
        @slot('add_btn')  @endslot
        @slot('active') Services @endslot
    @endcomponent
    <!-- /.content-header -->

    <!-- show data table component -->
    @component('admin.components.data-table',['thead'=>
        ['S NO.','Service Title','Category','Provider','Amount','Date','Approved','Action']
    ])
        @slot('table_id') service-list @endslot
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
    var table = $("#service-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "services",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'image', name: 'image'},
            {data: 'category', name: 'category'},
            {data: 'user_name', name: 'provider'},
            {data: 'service_amount', name: 'amount'},
            {data: 'created_at', name: 'date'},
            {data: 'approved', name: 'approved'},
            {data: 'action', name: 'action'},
            // {
            //     data: 'action',
            //     name: 'action',
            //     orderable: true,
            //     searchable: true,
            //     sWidth: '100px'
            // }
        ]
    });
</script>
@stop