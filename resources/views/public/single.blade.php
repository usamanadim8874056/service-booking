@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="single-service-box">
                    <h2 class="section-head">{{ $service->service_name }}</h2>
                    <span class="service-category"><a href="{{ url('c/' . $service->category_slug) }}">{{ $service->category_name }}</a></span>
                    @php $images = array_filter(explode(',',$service->service_images)); @endphp
                    <div class="flexslider">
                        <ul class="slides">
                            @if (!empty($images))
                            @for ($i = 0; $i < count($images); $i++) <li data-thumb="{{ asset('public/services/' . $images[$i]) }}">
                                <img src="{{ asset('public/services/' . $images[$i]) }}" loading="lazy" />
                                </li>
                                @endfor
                                @else
                                <li data-thumb="{{ asset('public/services/default.jpg') }}">
                                    <img src="{{ asset('public/services/default.jpg') }}" loading="lazy" />
                                </li>
                                @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <span class="service-amount">{{ $siteInfo->cur_format }}{{ $service->service_amount }}</span>
                @if (session()->get('user_type') == 'provider')
                @if (session()->get('user_id') == $service->provider)
                <a href="{{ url('edit-service/' . $service->service_id) }}" class="btn link-btn d-block mb-4">Edit Service</a>
                @endif
                @elseif(session()->get('user_type') == 'user')
                <a href="{{ url('book-service/' . $service->service_slug) }}" class="btn link-btn d-block mb-4">Book Service</a>
                @else
                <div class="mb-4"></div>
                @endif

                <h3 class="sub-section-head mb-4">Service Provider</h3>
                <div class="provider-detail d-flex flex-column mb-4">
                    <div class="d-flex flex-row mb-4">
                        <img src="{{ asset('public/images/user.png') }}" loading="lazy">
                        <div>
                            <h5>{{ $provider->user_name }}</h5>
                            <span>Member Since : {{ date('d M, Y', strtotime($provider->created_at)) }}</span>
                        </div>
                    </div>
                    <span><i class="fa fa-envelope"></i> : {{ $provider->user_email }}</span>
                    <span><i class="fa fa-phone"></i> : {{ $provider->user_phone }}</span>
                </div>
                <h3 class="sub-section-head mb-4">Provider Availability</h3>
                @php
                $days_list = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                @endphp
                @if ($availability->isNotEmpty())
                <ul class="service-availability">
                    @foreach ($availability as $avail)
                    <li class="d-flex justify-content-between">
                        <span>{{ $days_list[$avail->day - 1] }}</span>
                        <span>{{ date('h:i A', strtotime($avail->from_time)) }} - {{ date('h:i A', strtotime($avail->to_time)) }}</span>
                    </li>
                    @endforeach
                </ul>
                @else
                <h5 class="m-0 mb-5">Not Available</h5>
                @endif
                <h3 class="sub-section-head mb-4">Service Time</h3>
                <ul class="service-availability">
                    <li><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($service->service_start_time)->format('h:i A') }}</li>
                    <li><strong>End Time:</strong> {{ \Carbon\Carbon::parse($service->service_end_time)->format('h:i A') }}</li>
                </ul>
                @if ($related->isNotEmpty())
                <h3 class="sub-section-head">Related Services</h3>
                @foreach ($related as $item)
                <div class="sidebar-service-box">
                    <h5><a href="{{ url($cat_slug . '/' . $item->service_slug) }}">{{ $item->service_name }}</a></h5>
                </div>
                @endforeach
                @endif
            </div>
            <div class="col-md-8">
                <h3 class="sub-section-head">Service Details</h3>
                <div class="m-0 mb-5">
                    <p>{!! htmlspecialchars_decode($service->service_description) !!}</p>
                </div>
                @if ($related->isNotEmpty())
                <h3 class="sub-section-head">Related Services</h3>
                <div class="owl-carousel related-posts owl-theme position-relative">
                    @foreach ($related as $item)
                    <div class="item">
                        <div class="service-box h-100 d-flex flex-column">
                            <div class="position-relative">
                                @if ($item->service_images != '')
                                @php
                                $images = array_filter(explode(',', $item->service_images));
                                @endphp
                                <img src="{{ asset('public/services/' . $images[0]) }}" alt="{{ $item->category_name }}" loading="lazy" />
                                @else
                                <img src="{{ asset('public/services/default.jpg') }}" alt="{{ $item->category_name }}" loading="lazy" />
                                @endif
                                <span class="service-amount">{{ $siteInfo->cur_format }}{{ $item->service_amount }}</span>
                            </div>
                            <div class="content mt-auto">
                                <h3><a href="{{ url($item->category_slug . '/' . $item->service_slug) }}">{{ $item->service_name }}</a></h3>
                                <span><i class="fa fa-cube"></i> <a href="{{ url('/c/' . $item->category_slug) }}">{{ $item->category_name }}</a></span>
                                <span><i class="fa fa-clock"></i> {{ \Carbon\Carbon::parse($item->service_start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($item->service_end_time)->format('h:i A') }}</span>
                                <div>{!! substr(htmlspecialchars_decode($item->service_description), 0, 100) . '...' !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('public/layout/footer')