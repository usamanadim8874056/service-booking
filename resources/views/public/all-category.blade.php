@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 d-flex flex-row justify-content-between align-items-center">
                <h2 class="section-head">All Categories</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Categories</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            @foreach($categories as $item)
            @if($item->count > 0)
            <div class="col-md-3 mb-4">
                <a href="{{url('/c/'.$item->category_slug)}}" class="category-box h-100 d-flex flex-column">
                    @if($item->image != '')
                    <img src="{{asset('public/category/'.$item->image)}}" alt="{{$item->category_name}}" loading="lazy" />
                    @else
                    <img src="{{asset('public/category/default.jpg')}}" alt="{{$item->category_name}}" loading="lazy" />
                    @endif
                    <div class="content mt-auto">
                        <h3>{{$item->category_name}}</h3>
                    </div>
                </a>
            </div>
            @endif
            @endforeach
            <div class="col-md-12">
                {{$categories->links()}}
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')