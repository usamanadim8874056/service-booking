@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
        @include('public/profile-sidebar')
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">My Profile</h2>
                <form id="update-profile">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="d-flex flex-column user-image-box">
                                @if($user->user_image != '')
                                <img src="{{asset('public/users/'.$user->user_image)}}" id="image" class="img-thumbnail">
                                @else
                                <img src="{{asset('public/users/default.png')}}" id="image" class="img-thumbnail">
                                @endif
                                <input type="file" name="user_image" id="user-image" onChange="readURL(this);" hidden>
                                <input type="text" hidden name="old_img" value="{{$user->user_image}}">
                                <button type="button" class="btn link-btn browse-user">Browse</button>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Name</label>
                            <input type="text" name="user_name" value="{{$user->user_name}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Email</label>
                            <input type="email" name="user_email" class="form-control" value="{{$user->user_email}}" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Mobile Number</label>
                            <input type="number" name="user_phone" class="form-control" value="{{$user->user_phone}}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Address</label>
                            <input type="text" name="user_address" class="form-control" value="{{$user->user_address}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">City</label>
                            <select name="user_city" class="form-control">
                                <option value="" selected disabled>Select City</option>
                                @foreach($cities as $city)
                                    @php $selected = ($city->city_id == $user->user_city) ? 'selected' : '';   @endphp
                                    <option value="{{$city->city_id}}" {{$selected}}>{{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary link-btn ShowProfile">Update Profile</button>
                        </div>
                        <div class="col-md-12">
                        <div class="message"></div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')