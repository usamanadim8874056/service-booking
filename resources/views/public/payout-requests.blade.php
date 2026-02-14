@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
        @include('public/profile-sidebar')
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">Payout Requests</h2>
                @if(!$payout_settings)
                <p class="alert alert-danger">Please enter your bank details in <a href="{{url('payout-settings')}}" class="text-dark"><b>Payout Settings</b></a> to complete your payout requests.</p>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Created On</th>
                            <th>Amount</th>
                            <th>Completed On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($payout_requests as $row)
                        @php $i++; @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{date('d M, Y',strtotime($row->created_at))}}</td>
                            <td>{{$row->amount}}</td>
                            <td>{{($row->completed_on != '') ? date('d M, Y',strtotime($row->completed_on)) : ''}}</td>
                            <td>@if($row->status == '1')
                                <span class="btn btn-success btn-sm">Completed</span>
                            @elseif($row->status == '-1')
                                <span class="btn btn-danger btn-sm">Rejected</span>
                            @else
                                <span class="btn btn-warning btn-sm">Pending</span>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')