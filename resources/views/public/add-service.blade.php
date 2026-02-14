@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            @include('public/profile-sidebar')
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">Add Service</h2>
                <form id="add-service" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Service Title</label>
                            <input type="text" class="form-control" name="s_title">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Category</label>
                            <select name="s_cat" class="form-control">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->cat_id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Service Amount</label>
                            <input type="number" class="form-control" name="s_amount">
                            @if ($commission->type == 'percentage')
                                @php $comm = $commission->value.'%'; @endphp
                            @else
                                @php $comm = $cur_format.$commission->value; @endphp
                            @endif
                            <small>({{ $comm }} Commission Will be included)</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Service Location</label>
                            <select name="s_location" class="form-control">
                                <option value="" selected disabled>Select Location</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Availability Start Time</label>
                            <input type="time" class="form-control" name="s_start_time">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Availability End Time</label>
                            <input type="time" class="form-control" name="s_end_time">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Images</label>
                            <div class="service-images"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Description</label>
                            <textarea name="s_desc" class="form-control summernote"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')
