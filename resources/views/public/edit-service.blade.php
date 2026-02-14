@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            @include('public/profile-sidebar')
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">Edit Service</h2>
                <form id="edit-service" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Service Title</label>
                            <input type="text" class="form-control" name="s_title" value="{{ $service->service_name }}">
                            <input type="text" name="id" value="{{ $service->service_id }}" hidden>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Category</label>
                            <select name="s_cat" class="form-control">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $cat)
                                    @php $selected = ($cat->cat_id == $service->category) ? 'selected' : '';  @endphp
                                    <option value="{{ $cat->cat_id }}" {{ $selected }}>{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Service Amount</label>
                            <input type="number" class="form-control" name="s_amount" value="{{ $service->service_amount }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Service Location</label>
                            <select name="s_location" class="form-control">
                                <option value="" selected disabled>Select Location</option>
                                @foreach ($cities as $city)
                                    @php $selected1 = ($city->city_id == $service->location) ? 'selected' : '';  @endphp
                                    <option value="{{ $city->city_id }}" {{ $selected1 }}>{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Availability Start Time</label>
                            <input type="time" class="form-control" name="s_start_time" value="{{ $service->service_start_time }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Availability End Time</label>
                            <input type="time" class="form-control" name="s_end_time" value="{{ $service->service_end_time }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Images</label>
                            <div class="services-images1"></div>
                            <input type="text" hidden name="old_images" value="{{ $service->service_images }}">
                            @php
                                $gallery = array_filter(explode(',', $service->service_images));
                                $gallery_array = [];
                                for ($i = 0; $i < count($gallery); $i++) {
                                    $g = (object) ['id' => $i + 1, 'src' => asset('public/services/' . $gallery[$i])];
                                    array_push($gallery_array, $g);
                                }
                            @endphp
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Description</label>
                            <textarea name="s_desc" class="form-control summernote">{!! $service->service_description !!}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-primary" value="Update" name="Update">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')
