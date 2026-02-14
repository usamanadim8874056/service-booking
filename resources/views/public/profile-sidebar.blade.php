<div class="col-lg-3 col-md-4">
    <div class="user-sidebar">
        <div class="user-info d-flex flex-row">
            @if($user->user_image != '')
            <img src="{{asset('public/users/'.$user->user_image)}}" alt="" width="50px" class="rounded-circle">
            @else
            <img src="{{asset('public/users/default.png')}}" alt="" width="50px" class="rounded-circle">
            @endif
            <div>
                <h5>{{$user->user_name}}</h5>
                <span>Member Since {{date('M Y',strtotime($user->created_at))}}</span>
            </div>
        </div>
        <ul>
            <li><a href="{{url('dashboard')}}"><i class="fa fa-table"></i> Dashboard</a></li>
            @if(session()->get('user_type') == 'provider')
            <li><a href="{{url('my-services')}}"><i class="fa fa-book"></i> My Services</a></li>
            <li><a href="{{url('provider-bookings')}}"><i class="fa fa-calendar"></i> Booking List</a></li>
            @else
            <li><a href="{{url('my-bookings')}}"><i class="fa fa-calendar"></i> Booking List</a></li>
            @endif
            <li><a href="{{url('my-wallet')}}"><i class="fa fa-money-bill-wave"></i> Wallet</a></li>
            <li><a href="{{url('profile')}}"><i class="fa fa-user"></i> Profile Settings</a></li>
            @if(session()->get('user_type') == 'provider')
            <li><a href="{{url('payout-settings')}}"><i class="fa fa-cog"></i> Payout Settings</a></li>
            <li><a href="{{url('payout-requests')}}"><i class="fa fa-sign-out-alt"></i> Payout Requests</a></li>
            <li><a href="{{url('availability')}}"><i class="fa fa-clock"></i> Availability</a></li>
            @endif
        </ul>
    </div>
</div>