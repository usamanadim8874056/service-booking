<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Service Booking</title>
    <link rel="shortcut icon" href="{{asset('public/favicon.ico')}}" type="image/x-icon">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/assets/public/css/bootstrap.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap Core Css -->
    <link rel="stylesheet" href="{{asset('public/assets/public/css/bootstrap.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <link href="{{asset('public/assets/public/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{asset('public/assets/public/css/image-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/public/css/flexslider.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/public/css/style.css')}}">
</head>

<body>
    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('/')}}">{{$siteInfo->com_name}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('all-categories')}}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('contact')}}">Contact</a>
                    </li>
                    @if(session()->has('user_id') && session()->get('user_type') == 'provider')
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('add-service')}}">Post Service</a>
                    </li>
                    @endif
                    @if(session()->has('user_id'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{session()->get('user_name')}}
                        </a>
                        <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                            <li><a href="{{url('dashboard')}}" class="dropdown-item">Dashboard</a></li>
                            @if(session()->get('user_type') == 'provider')
                            <li><a href="{{url('my-services')}}" class="dropdown-item">My Services</a></li>
                            <li><a href="{{url('provider-bookings')}}" class="dropdown-item">Booking List</a></li>
                            @else
                            <li><a href="{{url('my-bookings')}}" class="dropdown-item">Booking List</a></li>
                            @endif

                            <li><a href="{{url('profile')}}" class="dropdown-item">Profile Settings</a></li>
                            <li><a href="{{url('change-password')}}" class="dropdown-item">Change Password</a></li>
                            @if(session()->get('user_type') == 'provider')
                            <li><a href="{{url('availability')}}" class="dropdown-item">Availability</a></li>
                            @endif
                            <!-- <li><hr class="dropdown-divider"></li> -->
                            <li><a href="{{url('logout')}}" class="dropdown-item">Logout</a></li>
                        </ul>
                    </li>
                    @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('provider-signup')}}">Become A Professional</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('signup')}}">Become A User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('login')}}">Login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- Nav Bar End -->