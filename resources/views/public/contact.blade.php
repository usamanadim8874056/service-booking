@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 d-flex flex-row justify-content-between align-items-center">
                <h2 class="section-head">Contact Us</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="signup-form" id="addContact" method="POST">
                    <h3>Get in touch</h3>
                    @csrf 
                    <div class="message"></div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_name" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="phone" placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" name="description" placeholder="Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary link-btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')