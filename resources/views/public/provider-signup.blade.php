@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 d-flex flex-row justify-content-between align-items-center">
                <h2 class="section-head">Join as Professional</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Join as Professional</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form class="signup-form" id="user-signup" method="POST">
                    <h3>Registration for Provider</h3>
                    <div class="message"></div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="user_name">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="">Mobile Number</label>
                        <input type="number" class="form-control" name="phone">
                        <input type="text" name="type" value="provider" hidden>
                    </div>
                   <button type="submit" class="btn btn-primary link-btn">Signup</button>
                   <span class="form-footer">Already have an account? Click here to <a href="{{url('/login')}}">Login</a></span>
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')