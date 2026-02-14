@extends('admin.layout')
@section('title','Bookings')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Bookings @endslot
        @slot('add_btn')  @endslot
        <!-- <a href="{{url('admin/services/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> -->
        @slot('active') Bookings @endslot
    @endcomponent
    <!-- /.content-header -->
    
    <!-- show data table component -->
    @component('admin.components.data-table',['thead'=>
        ['S NO.','Booking No.','Service','Provider','User','Date','Booked On','Status']
    ])
        @slot('table_id') bookings-list @endslot
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
    var table = $("#bookings-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "bookings",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'booking_id', name: 'booking_id'},
            {data: 'service_name', name: 'service_name'},
            {data: 'user_name', name: 'user'},
            {data: 'provider_name', name: 'provider'},
            {data: 'date', name: 'date'},
            {data: 'created_at', name: 'created'},
            {data: 'status', name: 'status'},
            
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