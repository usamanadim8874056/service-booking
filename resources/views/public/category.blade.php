@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 d-flex flex-row justify-content-between align-items-center">
                <h2 class="section-head">{{$category->category_name}}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$category->category_name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            @foreach($services as $item)
            <div class="col-md-4 mb-5">
                <div class="service-box h-100 d-flex flex-column">
                    <a href="{{ url($item->category_slug . '/' . $item->service_slug) }}">
                        <div class="position-relative">
                            @if($item->service_images != '')
                            @php
                            $images = array_filter(explode(',',$item->service_images));
                            @endphp
                            <img src="{{asset('public/services/'.$images[0])}}" alt="{{$item->category_name}}" loading="lazy" />
                            @else
                            <img src="{{asset('public/services/default.jpg')}}" alt="{{$item->category_name}}" loading="lazy" />
                            @endif
                            <span class="service-amount">{{$siteInfo->cur_format}}{{$item->service_amount}}</span>
                        </div>
                    </a>
                    <div class="content mt-auto">
                        <h3><a href="{{url($item->category_slug.'/'.$item->service_slug)}}">{{$item->service_name}}</a></h3>
                        <span><i class="fa fa-cube"></i> <a href="{{url('/c/'.$item->category_slug)}}">{{$item->category_name}}</a></span>
                        <span><i class="fa fa-clock"></i> {{ \Carbon\Carbon::parse($item->service_start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($item->service_end_time)->format('h:i A') }}</span>
                        <div>{!!substr(htmlspecialchars_decode($item->service_description),0,100).'...'!!}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@include('public/layout/footer')