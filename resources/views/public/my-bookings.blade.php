@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
        @include('public/profile-sidebar')
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">My Bookings</h2>
                @if($bookings->isNotEmpty())
                @foreach($bookings as $book)
                <div class="service-book-box d-flex mb-4">
                    @php $images = explode(',',$book->service_images); @endphp
                    <img src="{{asset('public/services/'.$images[0])}}" width="200px" class="mr-4"  alt="{{$book->service_name}}">
                    <div>
                        <div>
                            <h4>{{$book->service_name}}</h4>
                            <ul>
                                <li>
                                    <b>Booking Date :</b> {{date('d M, Y',strtotime($book->date))}}
                                    @if($book->status == '0' && $book->user_status == '0' && $book->provider_status == '0')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($book->status == '1' && $book->user_status == '0' && $book->provider_status == '0')
                                        <span class="badge badge-success">Accepted by Provider</span>
                                    @elseif($book->status == '-1' && $book->user_status == '0' && $book->provider_status == '0')
                                        <span class="badge badge-danger">Rejected by Provider</span>
                                    @elseif($book->status == '1' && $book->user_status == '1' && $book->provider_status == '0')
                                        <span class="badge badge-success">Request Completed by User</span>
                                    @elseif($book->status == '0' && $book->user_status == '-1' && $book->provider_status == '0')
                                        <span class="badge badge-danger">Cancelled by User</span>
                                    @elseif($book->status == '1' && $book->provider_status == '1')
                                        <span class="badge badge-success">Completed by Provider</span>
                                    @elseif($book->status == '1' && $book->provider_status == '1' && $book->user_status == '1')
                                        <span class="badge badge-success">Completed Successfully</span>
                                    @endif
                                </li>
                                <li><b>Amount :</b> {{$siteInfo->cur_format}}{{$book->service_amount}}</li>
                                <li><b>Location :</b> {{$book->city_name}}</li>
                                <li><b>Phone :</b> {{$book->user_phone}}</li>
                                @if(session()->get('user_type') == 'provider')
                                    <li><b>User :</b> {{$book->user_name}}</li>
                                    <li>
                                        @if($book->status == '0' && $book->user_status == '0' && $book->provider_status == '0')
                                            <button class="btn btn-sm alert-success accept-service" data-id="{{$book->id}}"><i class="fa fa-check"></i> Accept</button>
                                            <button class="btn btn-sm alert-danger reject-service" data-id="{{$book->id}}"><i class="fa fa-times"></i> Reject</button>
                                        @elseif($book->status == '1' && $book->provider_status == '0')
                                            <button class="btn btn-sm alert-success complete-booking" data-user="provider" data-id="{{$book->id}}"><i class="fa fa-check"></i> Complete Request</button>
                                        @endif
                                    </li>
                                @else
                                    <li><b>Provider :</b> {{$book->user_name}}</li>
                                    <li>
                                        @if($book->user_status == '0' && $book->provider_status == '0')
                                        <button class="btn btn-sm alert-danger cancel-booking" data-user="user" data-id="{{$book->id}}"><i class="fa fa-times"></i> Cancel</button>
                                        <button class="btn btn-sm alert-success complete-booking" data-user="user" data-id="{{$book->id}}"><i class="fa fa-check"></i> Complete Request</button>
                                        @else
                                            @if($book->user_status == '-1')
                                                <span class="badge badge-warning">Cancelled by User</span>
                                            @elseif($book->user_status == '1')
                                                <span class="badge badge-success">Completed by User</span>
                                            @elseif($book->provider_status == '-1')
                                                <span class="badge badge-warning">Cancelled by Provider</span>
                                            @elseif($book->provider_status == '1')
                                                <span class="badge badge-success">Completed by Provider</span>
                                            @endif
                                        @endif
                                    </li>
                                @endif
                                
                            </ul>
                        </div>
                        <div></div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-md-12">
                    <div class="no-record">
                        <h3>No Bookings Found</h3>
                        <!-- <a href="{{url('add-service')}}" class="btn link-btn">Post a Service</a> -->
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')




























