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
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    tabindex="0">

    {{-- <div class="search-popup">
        <div class="search-popup-container">

            <form role="search" method="get" class="search-form" action="">
                <input type="search" id="search-form" class="search-field" placeholder="Type and press enter"
                    value="" name="s" />
                <button type="submit" class="search-submit"><svg class="search">
                        <use xlink:href="#search"></use>
                    </svg></button>
            </form>

            <h5 class="cat-list-title">Browse Categories</h5>

            <ul class="cat-list">
                <li class="cat-list-item">
                    <a href="#" title="Mobile Phones">Mobile Phones</a>
                </li>
                <li class="cat-list-item">
                    <a href="#" title="Smart Watches">Smart Watches</a>
                </li>
                <li class="cat-list-item">
                    <a href="#" title="Headphones">Headphones</a>
                </li>
                <li class="cat-list-item">
                    <a href="#" title="Accessories">Accessories</a>
                </li>
                <li class="cat-list-item">
                    <a href="#" title="Monitors">Monitors</a>
                </li>
                <li class="cat-list-item">
                    <a href="#" title="Speakers">Speakers</a>
                </li>
                <li class="cat-list-item">
                    <a href="#" title="Memory Cards">Memory Cards</a>
                </li>
            </ul>

        </div>
    </div>

    <header id="header" class="site-header header-scrolled position-fixed text-black bg-light">
        <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">
                    <img src="{{ asset('frontend/images/main-logo.png') }}" class="logo">
                </a>
                <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <svg class="navbar-icon">
                        <use xlink:href="#navbar-icon"></use>
                    </svg>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar"
                    aria-labelledby="bdNavbarOffcanvasLabel">
                    <div class="offcanvas-header px-4 pb-0">
                        <a class="navbar-brand" href="index.html">
                            <img src="{{ asset('frontend/images/main-logo.png') }}" class="logo">
                        </a>
                        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"
                            aria-label="Close" data-bs-target="#bdNavbar"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul id="navbar"
                            class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link me-4 active" href="#billboard">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-4" href="#company-services">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-4" href="#mobile-products">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-4" href="#smart-watches">Watches</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-4" href="#yearly-sale">Sale</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-4" href="#latest-blog">Blog</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown"
                                    href="#" role="button" aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="about.html" class="dropdown-item">About</a>
                                    </li>
                                    <li>
                                        <a href="blog.html" class="dropdown-item">Blog</a>
                                    </li>
                                    <li>
                                        <a href="shop.html" class="dropdown-item">Shop</a>
                                    </li>
                                    <li>
                                        <a href="cart.html" class="dropdown-item">Cart</a>
                                    </li>
                                    <li>
                                        <a href="checkout.html" class="dropdown-item">Checkout</a>
                                    </li>
                                    <li>
                                        <a href="single-post.html" class="dropdown-item">Single Post</a>
                                    </li>
                                    <li>
                                        <a href="single-product.html" class="dropdown-item">Single Product</a>
                                    </li>
                                    <li>
                                        <a href="contact.html" class="dropdown-item">Contact</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <div class="user-items ps-5">
                                    <ul class="d-flex justify-content-end list-unstyled">
                                        <li class="search-item pe-3">
                                            <a href="#" class="search-button">
                                                <svg class="search">
                                                    <use xlink:href="#search"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="pe-3">
                                            <a href="#">
                                                <svg class="user">
                                                    <use xlink:href="#user"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="cart.html">
                                                <svg class="cart">
                                                    <use xlink:href="#cart"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header> --}}
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @php $total_price=[]; @endphp
                    @foreach ($details as $key => $detail)
                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <img src="{{ asset('storage/product/images') . '/' . $detail->products[0]->image }}"
                                            class="img-fluid rounded-3" alt="Cotton T-shirt">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <p class="lead fw-normal mb-2">{{ $detail->products[0]->name }}</p>
                                        <p><span class="text-muted">Size: </span>M <span class="text-muted">Color:
                                            </span>Grey</p>
                                        @if ($detail->products[0]->quantity < $detail->qnty)
                                            <p class="text-danger">Out of Stock</p>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(); updateCart('qnty_{{ $key }}', '{{ $detail->products[0]->id }}', {{ $key }}, {{ $detail->id }});">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-cart-dash" viewBox="0 0 16 16">
                                                <path d="M6.5 7a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                                                <path
                                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                            </svg>
                                        </button>

                                        <input min="0" name="quantity" id="qnty_{{ $key }}"
                                            value="{{ $detail->qnty }}" type="number"
                                            class="form-control form-control-sm" />

                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp();updateCart('qnty_{{ $key }}', '{{ $detail->products[0]->id }}', {{ $key }}, {{ $detail->id }});">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                <path
                                                    d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                                <path
                                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h5 class="mb-0" id="price_{{ $key }}">
                                            ${{ number_format($detail->t_price, 2) }}</h5>
                                        <p style="display: none;" class="price" id="h_price_{{ $key }}">
                                            {{ $detail->t_price }}</p>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <a href="{{ route('remove.cart.item', ['id' => $detail->id]) }}"
                                            class="text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-cart-x" viewBox="0 0 16 16">
                                                <path
                                                    d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793z" />
                                                <path
                                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $total_price[] = $detail->t_price; @endphp
                    @endforeach

                    <div class="card mb-4">
                        <div class="card-body p-4 d-flex flex-row">
                            <div data-mdb-input-init class="form-outline flex-fill">
                                <input type="text" id="form1" name="discount"
                                    class="form-control form-control-lg" />
                                <label class="form-label" for="form1">Discount code</label>
                            </div>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-outline-warning btn-lg ms-3" onclick="coupon_apply()">Apply</button>
                        </div>
                    </div>

                    @if (!empty($cart_setting->gst))
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="mb-4">GST Details</h5>
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">GST ({{ $cart_setting->gst }}%)</p>
                                    <p class="mb-2">$<span
                                            id="gst_price">{{ number_format((array_sum($total_price) * $cart_setting->gst) / 100, 2) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-body">
                            Total amount of products in your cart
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Total Price</p>
                                <p class="mb-2">$<span
                                        id="t_price">{{ number_format(array_sum($total_price), 2) }}</span></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Total Discount</p>
                                <p class="mb-2">$<span id="t_discount"></span></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Discount Price</p>
                                <p class="mb-2">$<span id="d_price"></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-warning btn-block btn-lg" onclick="showModal()">Proceed to
                                Pay</button>
                        </div>
                    </div>

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
                                <p>Do you have any queries or suggestions? <a href="mailto:">info@webfintech.in</a>
                                </p>
                                <p>If you need support? Just give us a call. <a href="">+91-8303812139</a>
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
                        <p>© Copyright @php echo date('Y'); @endphp WEBFINTECH DIGITAL PVT LTD. Design by <a
                                href="{{ route('home') }}">WEBFINTECH DIGITAL PVT LTD</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="paymentModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Mode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="$('#paymentModal').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Choose your payment method</p>
                    @if ($cart_setting->wallet_payment_mode == 1)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" value="wallet"
                                onclick="hidePaymentBtn()">
                            <label class="form-check-label" for="creditCard">
                                Wallet Payment
                            </label>
                        </div>
                    @endif

                    @if ($cart_setting->cod_payment_mode == 1)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" value="cod"
                                onclick="hidePaymentBtn()">
                            <label class="form-check-label" for="creditCard">
                                Cash On Delivery
                            </label>
                        </div>
                    @endif

                    @if ($cart_setting->online_payment_mode == 1)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" value="online"
                                onclick="showPaymentBtn()">
                            <label class="form-check-label" for="creditCard">
                                Online Payment
                            </label>
                        </div>
                        <div id="payment_btn" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- <a href="{{ route('razorpay.index', ['order_id' => $details[0]->order_unique_id]) }}" class="btn btn-primary">Razorpay</a> --}}
                                    <button class="btn btn-sm btn-primary"
                                        onclick="razorpayPayment()">Razorpay</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-primary">Stripe</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="coupon_id" value="">
                    <button type="button" class="btn btn-primary" onclick="proceedToPay()"
                        id="proceedToPayBtn">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="$('#paymentModal').modal('hide');">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('frontend/js/jquery-1.11.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function hidePaymentBtn() {
            $("#payment_btn").hide();
        }

        function showPaymentBtn() {
            $("#payment_btn").show();
        }

        function showModal() {
            $("#paymentModal").modal("show");
        }

        function razorpayPayment() {
            $("#proceedToPayBtn").prop("disabled", true);
            var total_price = $("#t_price").text();
            var discount = $("#t_discount").text();
            var final_price = $("#d_price").text();
            var paymentMethod = $("input[name='paymentMethod']:checked").val();
            var coupon_id = $("#coupon_id").val();
            if (final_price == "") {
                final_price = total_price;
            }
            const base_url = "{{ url('/razorpay') }}";
            const orderId = "{{ $details[0]->order_unique_id }}";

            let finalUrl = `${base_url}/${orderId}/${total_price}/${final_price}`;
            if (coupon_id) {
                finalUrl += `/${coupon_id}`;
            }

            window.location.href = finalUrl;
        }

        function proceedToPay() {
            $("#proceedToPayBtn").prop("disabled", true);
            var total_price = $("#t_price").text();
            var discount = $("#t_discount").text();
            var final_price = $("#d_price").text();
            var paymentMethod = $("input[name='paymentMethod']:checked").val();
            var coupon_id = $("#coupon_id").val();
            if (final_price == "") {
                final_price = total_price;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('proceed.to.pay') }}",
                data: "total_price=" + total_price + "&discount=" + discount + "&final_price=" + final_price +
                    "&order_id={{ $details[0]->order_unique_id }}" + "&payment_method=" + paymentMethod +
                    "&coupon_id=" + coupon_id,
                success: function(data) {
                    console.log(data);
                    $("#proceedToPayBtn").prop("disabled", false);
                    if (data.status == "error") {
                        alert(data.message);
                    } else {
                        alert(data.message);
                        // window.location.href = "{{ route('e.commerce') }}";
                    }
                }
            });
        }

        function numberFormat(num, decimals = 2, dec_point = '.', thousands_sep = ',') {
            let parts = parseFloat(num).toFixed(decimals).split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
            return parts.join(dec_point);
        }

        function updateCart(input_id, product_id, counter, order_id) {
            console.log(counter);
            var get_data = $("#" + input_id).val();
            $.ajax({
                type: "POST",
                url: "{{ route('check.stock') }}",
                data: "get_data=" + get_data + "&pro_id=" + product_id + "&order_id=" + order_id,
                success: function(data) {
                    if (data.status == "error") {
                        alert(data.message);
                        $("#" + input_id).val(get_data - 1);
                    } else {
                        $("#price_" + counter).html("$" + data.price);
                        $("#h_price_" + counter).html(data.normal_price);
                        var total = 0;
                        $(".price").each(function() {
                            console.log($(this).text());
                            total += parseFloat($(this).text());
                        });
                        console.log(total);
                        $("#t_price").html(numberFormat(total));
                    }
                }
            });
        }

        function coupon_apply() {
            var discount_code = $("#form1").val();
            var total_amount = $("#t_price").text();
            $.ajax({
                type: "POST",
                url: "{{ route('apply.coupon') }}",
                data: "discount_code=" + discount_code + "&total_amount=" + total_amount,
                success: function(data) {
                    if (data.status == "error") {
                        alert(data.message);
                    } else {
                        $("#coupon_id").val(data.coupon_id);
                        $("#t_discount").html(data.discount);
                        var total_price = parseFloat($("#t_price").text());
                        var discount = parseFloat(data.discount);
                        var final_price = total_price - discount;
                        $("#d_price").html(final_price.toFixed(2));
                    }
                }
            });
        }
    </script>
</body>

</html>
