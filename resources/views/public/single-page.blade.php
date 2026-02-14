@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 d-flex flex-row justify-content-between align-items-center">
                <h2 class="section-head">{{$page_detail->page_title}}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$page_detail->page_title}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <p>{!!htmlspecialchars_decode($page_detail->page_content)!!}</p>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')