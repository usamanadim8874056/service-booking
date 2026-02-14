<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="footer-widget">
                    <h5 class="logo text-uppercase mb-4"><a href="#">{{$siteInfo->com_name}}</a></h5>
                    <p class="mb-4">{{$siteInfo->description}}</p>
                    <ul class="icon">
                        @foreach($social_links as $social)
                        @if($social->facebook != '')
                            <li><a href="{{$social->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if($social->twitter != '')
                        <li><a href="{{$social->twitter}}"><i class="fab fa-twitter"></i></a></li>
                        @endif
                        @if($social->instagram != '')
                        <li><a href="{{$social->instagram}}"><i class="fab fa-instagram"></i></a></li>
                        @endif
                        @if($social->you_tube != '')
                        <li><a href="{{$social->you_tube}}"><i class="fab fa-youtube"></i></a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="footer-widget">
                    <h6 class="text-white text-uppercase mb-4">Latest Categories</h6>
                    <ul class="newsfeed text-capitalize">
                        @foreach($latest_categories as $category)
                        @if($category->count > 0)
                        <li><a href="{{url('/c/'.$category->category_slug)}}">{{$category->category_name}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="footer-widget">
                    <h6 class="text-white text-uppercase mb-4">Useful Links</h6>
                    <ul class="newsfeed text-capitalize">
                        @if(session()->has('user_id'))
                        <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                        @else
                        <li><a href="{{url('provider-signup')}}">Become A Professional</a></li>
                        <li><a href="{{url('signup')}}">Become A User</a></li>
                        @endif
                        <li><a href="{{url('/contact')}}">Contact Us</a></li>
                        @foreach($footer_pages as $page)
                        <li><a href="{{url('/'.$page->page_slug)}}">{{$page->page_title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="footer-widget">
                    <h6 class="text-white text-uppercase mb-3">contact us</h6>
                    <ul class="contacts">
                        <li class="mb-2"><i class="fas fa-map-marker-alt"></i>{{$siteInfo->address}}</li>
                        <li class="mb-2"><i class="fa fa-phone"></i><a href="#">{{$siteInfo->com_phone}}</a></li>
                        <li><i class="far fa-envelope"></i><a href="#">{{$siteInfo->com_email}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-widget footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>{{$siteInfo->copyright_text}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('public/assets/public/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('public/assets/public/js/popper.min.js')}}"></script>
<script src="{{asset('public/assets/public/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('public/assets/public/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/assets/public/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('public/assets/public/js/image-uploader.js')}}"></script>
<script src="{{asset('public/assets/public/js/plugins.js')}}"></script>
<script src="{{asset('public/assets/public/js/jquery.validate.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{asset('public/assets/public/js/action.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
<script src="{{asset('public/assets/public/js/jquery.flexslider-min.js')}}"></script>
<script src="{{asset('public/assets/public/js/modernizr.js')}}"></script>
<input type="hidden" class="demo" value="{{url('/')}}"></input>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
    $(document).ready(function(){
        $('.summernote').summernote();

        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });

        // for create page
        $('.service-images').imageUploader({
            imagesInputName: 'gallery',
            'label': 'Drag and Drop'
        });

        // for edit page

        var preloaded = [];
        <?php if(!empty($gallery_array)){ ?>
        var preloaded = <?php echo json_encode($gallery_array); ?>;
        <?php  } ?>

        $('.services-images1').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'gallery1',
            'label': 'Drag and Drop',
            preloadedInputName: 'old',
            maxFiles: 10,
            maxSize: 2 * 1024 * 1024,
        });

        $('.related-posts').owlCarousel({
            loop:false,
            margin:25,
            nav:false,
            responsive:{
                0:{ items:1 },
                600:{ items:2 },
                1000:{ items:2 }
            }
        })
    })


</script>
@if(Request::path() == 'my-wallet')
<script src="https://checkout.razorpay.com/v1/checkout.js" type="text/javascript"></script>
<script>
    var uRL = $('.demo').val();
    $('#add-payment-wallet').submit(function(e){
        e.preventDefault();
        $('.message').empty();
        var amount = $('input[name=amount]').val();
        var method = $('input[name=pay_method]:checked').val();
        var min_add = $('input[name=min_add]').val();
        if(amount == '' || parseInt(amount) < parseInt(min_add)){
            $('.message').html('<p class="alert alert-danger">Enter Correct Amount</p>');
        }else if(method == ''){
            $('.message').append('<p class="alert alert-danger">Select Payment Method</p>');
        }else{
            if(method == 'paypal'){
                window.location.href = uRL+'/pay-with-paypal/'+amount;
            }else{
                // alert(1);
                var tr = '';
                var razorpay = new Razorpay({
                    key: $('input[name=razor_key]').val(),
                    amount: amount*100,
                    name: 'Wallet Top Up',
                    order_id: '',
                    handler: function (transaction) {
                        console.log(transaction);
                        tr = transaction.razorpay_payment_id;
                        window.location.href = uRL+'/pay-with-razorpay/'+amount+'/'+tr;

                    }
                });
                razorpay.open();

            }
        }
    })
</script>

@endif
</body>
</html>