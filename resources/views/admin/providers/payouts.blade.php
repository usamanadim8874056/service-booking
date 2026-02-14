@extends('admin.layout')
@section('title','Payout Requests')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Payout Requests @endslot
        @slot('add_btn')@endslot
        @slot('active') Payout Requests @endslot
    @endcomponent
    <!-- /.content-header -->
    <!-- show data table component -->
    @component('admin.components.data-table',['thead'=>
        ['S NO.','Provider Name','Amount','Created On','Completed On','Status','Action']
    ])
        @slot('table_id') payout-list @endslot
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
    var table = $("#payout-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "payouts",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'user_name', name: 'name'},
            {data: 'amount', name: 'amount'},
            {data: 'created_at', name: 'date'},
            {data: 'completed_on', name: 'date'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });
</script>
@stop