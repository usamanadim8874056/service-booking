@include('public/layout/header')
<!-- Banner Start -->
<div id="banner" class="py-5" style="background-image:url('public/images/{{ $banner->banner_image }}')">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="banner-content">
                    <h1 class="mb-3">{{ $banner->title }}</h1>
                    <p>{{ $banner->sub_title }}</p>
                    <form action="{{ url('/search') }}" class="search-form d-flex flex-md-row flex-column">
                        <div class="flex-fill mb-3 mb-md-0">
                            <input type="text" name="search" class="form-control" placeholder="What are you looking for?" required>
                        </div>
                        <div class="flex-fill mb-3 mb-md-0">
                            <select name="location" class="form-control">
                                <option value="" selected disabled>Select Location</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary link-btn">Search <i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Banner End -->
<div id="category-section" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 d-flex flex-row justify-content-between">
                <h2 class="section-head">Latest Category</h2>
                <a href="{{ url('/all-categories') }}" class="link-btn">See All <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($category as $item)
            @if ($item->count > 0)
            <div class="col-md-3 mb-4">
                <a href="{{ url('/c/' . $item->category_slug) }}" class="category-box h-100 d-flex flex-column">
                    @if ($item->image != '')
                    <img src="{{ asset('public/category/' . $item->image) }}" alt="{{ $item->category_name }}" loading="lazy" />
                    @else
                    <img src="{{ asset('public/category/default.jpg') }}" alt="{{ $item->category_name }}" loading="lazy" />
                    @endif
                    <div class="content mt-auto">
                        <h3>{{ $item->category_name }}</h3>
                    </div>
                </a>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
<div id="services-section" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 d-flex flex-row justify-content-between">
                <h2 class="section-head">Featured Services</h2>
                <!-- <a href="" class="link-btn">See All <i class="fa fa-arrow-right"></i></a> -->
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($services as $item)
            <div class="col-md-4 mb-5">
                <div class="service-box h-100 d-flex flex-column">
                    <a href="{{ url($item->category_slug . '/' . $item->service_slug) }}">
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
                    </a>
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
    </div>
</div>
@include('public/layout/footer')