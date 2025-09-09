<!DOCTYPE html>
<html>

<head>
    <title>Ministore</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap"
        rel="stylesheet">
    <!-- script
    ================================================== -->
    <script src="{{ asset('frontend/js/modernizr.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    tabindex="0">
    <section class="h-100">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="{{ route('e.commerce') }}" class="btn btn-sm btn-primary">Back To Website</a>
                        <h3 class="fw-normal mb-0">Shopping Cart</h3>
                        {{-- <div>
                            <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                                    class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                        </div> --}}
                    </div>
                    @if (session('success'))
                        <p style="color:green;">{{ session('success') }}</p>
                    @elseif(session('error'))
                        <p style="color:red;">{{ session('error') }}</p>
                    @endif

                    <form action="{{ route('razorpay.payment') }}" method="POST">
                        @csrf
                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ config('services.razorpay.key') }}"
                            data-amount="{{ $total_price }}" 
                            data-currency="INR" 
                            data-buttontext="Please Pay {{ $main_price }} INR" 
                            data-name="{{ env('APP_NAME') }}"
                            data-description="Test Transaction"
                            data-notes.order_id= "{{ $order_id }}",
                            data-notes.coupon_id= "{{ $coupon_id }}",
                            data-notes.actual_price= "{{ $actual_price }}",
                            data-prefill.name="{{ $user_details->name }}" 
                            data-prefill.email="{{ $user_details->email }}"
                            data-theme.color="#F37254">
                        </script>
                        <input type="hidden" custom="Hidden Element" name="hidden">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer" class="overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="footer-top-area">
                    <div class="row d-flex flex-wrap justify-content-between">
                        <div class="col-lg-3 col-sm-6 pb-3">
                            <div class="footer-menu">
                                <img src="{{ asset('frontend/images/main-logo.png') }}" alt="logo">
                                <p>Nisi, purus vitae, ultrices nunc. Sit ac sit suscipit hendrerit. Gravida massa
                                    volutpat aenean odio erat nullam fringilla.</p>
                                <div class="social-links">
                                    <ul class="d-flex list-unstyled">
                                        <li>
                                            <a href="#">
                                                <svg class="facebook">
                                                    <use xlink:href="#facebook" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg class="instagram">
                                                    <use xlink:href="#instagram" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg class="twitter">
                                                    <use xlink:href="#twitter" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg class="linkedin">
                                                    <use xlink:href="#linkedin" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg class="youtube">
                                                    <use xlink:href="#youtube" />
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 pb-3">
                            <div class="footer-menu text-uppercase">
                                <h5 class="widget-title pb-2">Quick Links</h5>
                                <ul class="menu-list list-unstyled text-uppercase">
                                    <li class="menu-item pb-2">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="menu-item pb-2">
                                        <a href="#">About</a>
                                    </li>
                                    <li class="menu-item pb-2">
                                        <a href="#">Shop</a>
                                    </li>
                                    <li class="menu-item pb-2">
                                        <a href="#">Blogs</a>
                                    </li>
                                    <li class="menu-item pb-2">
                                        <a href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 pb-3">
                            <div class="footer-menu text-uppercase">
                                <h5 class="widget-title pb-2">Help & Info Help</h5>
                                <ul class="menu-list list-unstyled">
                                    <li class="menu-item pb-2">
                                        <a href="#">Track Your Order</a>
                                    </li>
                                    <li class="menu-item pb-2">
                                        <a href="#">Returns Policies</a>
                                    </li>
                                    <li class="menu-item pb-2">
                                        <a href="#">Shipping + Delivery</a>
                                    </li>
                                    <li class="menu-item pb-2">
                                        <a href="#">Contact Us</a>
                                    </li>
                                    <li class="menu-item pb-2">
                                        <a href="#">Faqs</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 pb-3">
                            <div class="footer-menu contact-item">
                                <h5 class="widget-title text-uppercase pb-2">Contact Us</h5>
                                <p>Do you have any queries or suggestions? <a href="mailto:">yourinfo@gmail.com</a>
                                </p>
                                <p>If you need support? Just give us a call. <a href="">+55 111 222 333 44</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </footer>
    <div id="footer-bottom">
        <div class="container">
            <div class="row d-flex flex-wrap justify-content-between">
                <div class="col-md-4 col-sm-6">
                    <div class="Shipping d-flex">
                        <p>We ship with:</p>
                        <div class="card-wrap ps-2">
                            <img src="{{ asset('frontend/images/dhl.png') }}" alt="visa">
                            <img src="{{ asset('frontend/images/shippingcard.png') }}" alt="mastercard">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="payment-method d-flex">
                        <p>Payment options:</p>
                        <div class="card-wrap ps-2">
                            <img src="{{ asset('frontend/images/visa.jpg') }}" alt="visa">
                            <img src="{{ asset('frontend/images/mastercard.jpg') }}" alt="mastercard">
                            <img src="{{ asset('frontend/images/paypal.jpg') }}" alt="paypal">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="copyright">
                        <p>© Copyright 2023 MiniStore. Design by <a
                                href="https://templatesjungle.com/">TemplatesJungle</a> Distribution by <a
                                href="https://themewagon.com">ThemeWagon</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('frontend/js/jquery-1.11.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script>
</body>

</html>
