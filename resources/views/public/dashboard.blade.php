@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
        @include('public/profile-sidebar')
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">Dashboard</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="dash-widget d-flex justify-content-between align-items-center">
                            <div class="dash-widget-icon">{{$bookings_count}}</div>
                            <span class="dash-widget-info">Bookings</span>
                        </div>
                    </div>
                    @if($services > 0)
                    <div class="col-md-6">
                        <div class="dash-widget d-flex justify-content-between align-items-center">
                            <div class="dash-widget-icon">{{$services}}</div>
                            <span class="dash-widget-info">Services</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')