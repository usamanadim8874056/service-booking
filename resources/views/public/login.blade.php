@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 d-flex flex-row justify-content-between align-items-center">
                <h2 class="section-head">Login</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="login-form" id="user-login" method="POST">
                    <h3>Welcome User</h3>
                    @csrf 
                    <div class="message"></div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary link-btn">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')