@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-3 d-flex flex-row justify-content-between align-items-center">
                <h2 class="section-head">Search : "{{ $request->search != '' ? $request->search : '' }}"</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <form action="{{ url('/search') }}" class="search-form filter d-flex flex-md-row flex-column mb-4">
                    <div class="flex-fill mb-3 mb-md-0">
                        <input type="text" name="search" class="form-control" value="{{ $request->input('search') != '' ? $request->input('search') : '' }}" placeholder="What are you looking for?" required>
                    </div>
                    <div class="flex-fill mb-3 mb-md-0">
                        <select name="location" class="form-control">
                            <option value="" selected disabled>Select Location</option>
                            @foreach ($cities as $city)
                                @if ($request->input('location') != '' && $request->input('location') == $city->city_name)
                                    <option value="{{ $city->city_name }}" selected>{{ $city->city_name }}</option>
                                @else
                                    <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary link-btn">Search <i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="row">
            @if ($services->isNotEmpty())
                @foreach ($services as $item)
                    <div class="col-md-4 mb-5">
                        <div class="service-box h-100 d-flex flex-column">
                            @if ($item->service_images != '')
                                @php
                                    $images = array_filter(explode(',', $item->service_images));
                                @endphp
                                <img src="{{ asset('public/services/' . $images[0]) }}" alt="{{ $item->category_name }}" />
                            @else
                                <img src="{{ asset('public/services/default.jpg') }}" alt="{{ $item->category_name }}" />
                            @endif
                            <div class="content mt-auto">
                                <h3><a href="{{ url($item->category_slug . '/' . $item->service_slug) }}">{{ $item->service_name }}</a></h3>
                                <span><i class="fa fa-cube"></i> <a href="{{ url('/c/' . $item->category_slug) }}">{{ $item->category_name }}</a></span>
                                <span><i class="fa fa-clock"></i> {{ \Carbon\Carbon::parse($item->service_start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($item->service_end_time)->format('h:i A') }}</span>
                                <div>{!! substr(htmlspecialchars_decode($item->service_description), 0, 100) . '...' !!}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 text-center">
                    <h5>No Result Found</h5>
                </div>
            @endif
            <div class="col-md-12 text-center">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')
