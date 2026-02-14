@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
        @include('public/profile-sidebar')
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">My Services</h2>

                <div class="row">
                    @if($services->isNotEmpty())
                    @foreach($services as $item)
                    <div class="col-md-4 mb-5">
                        <div class="service-box h-100 d-flex flex-column">
                            <div class="position-relative">
                                @if($item->approved == '0')
                                <small class="bg-danger text-white px-2 py-1 font-weight-bold d-block position-absolute w-100">Hidden / Not Approved by Site Admin</small>
                                @endif
                            @if($item->service_images != '')
                                @php
                                $images = array_filter(explode(',',$item->service_images));
                                @endphp
                                <img src="{{asset('public/services/'.$images[0])}}" alt="{{$item->category_name}}" />
                            @else
                                <img src="{{asset('public/services/default.jpg')}}" alt="{{$item->category_name}}" />
                            @endif
                                <span class="service-amount">{{$siteInfo->cur_format}}{{$item->service_amount}}</span>
                            </div>
                            <div class="content mt-auto">
                                <h3><a href="{{url($item->category_slug.'/'.$item->service_slug)}}">{{$item->service_name}}</a></h3>
                                <span><i class="fa fa-cube"></i> <a href="{{url('/c/'.$item->category_slug)}}">{{$item->category_name}}</a></span>
                                <span><i class="fa fa-clock"></i> {{ \Carbon\Carbon::parse($item->service_start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($item->service_end_time)->format('h:i A') }}</span>
                                <div>{!!substr(htmlspecialchars_decode($item->service_description),0,100).'...'!!}</div>
                                <div class="d-flex flex-row justify-content-between action">
                                    <a href="{{url('edit-service/'.$item->service_id)}}"><i class="fa fa-edit"></i>  edit</a>
                                    @if($item->status == '1')
                                    <a href="javascript:void(0)" class="service-status" data-id="{{$item->service_id}}" data-status="0"><i class="fa fa-eye-slash"></i> Inactive</a>
                                    @else
                                    <a href="javascript:void(0)" class="service-status active" data-id="{{$item->service_id}}" data-status="1"><i class="fa fa-eye"></i> Active</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-md-12">
                        <div class="no-record">
                            <h3>No Services Found</h3>
                            <a href="{{url('add-service')}}" class="btn link-btn">Post a Service</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')