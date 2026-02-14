@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 d-flex flex-row justify-content-between align-items-center">
                <h2 class="section-head">Change Password</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="change-pwd-form" id="updatePassword" method="POST">
                    @csrf
                    <div class="message"></div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Current Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="new_pass" placeholder="New Password">
                    </div> 
                    <div class="form-group">
                        <input type="password" class="form-control" name="new_confirm" placeholder="Confirm Password">
                    </div> 
                    <button type="submit" class="btn btn-primary link-btn">Update</button>
                </form>   
            </div>
        </div>
    </div>
</div>
<div id="menu-list">
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-3 col-md-6 offset-sm-1 col-sm-10">
                 
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')