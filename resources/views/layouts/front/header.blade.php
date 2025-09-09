<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">Logis</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home') }}" class="@if(request()->segment(1)=='') active @endif">Home<br></a></li>
                <li><a href="{{ route('about') }}" class="@if(request()->segment(1)=='about') active @endif">About</a></li>
                <li><a href="{{ route('service') }}" class="@if(request()->segment(1)=='service') active @endif">Services</a></li>
                <li><a href="{{ route('pricing') }}" class="@if(request()->segment(1)=='pricing') active @endif">Pricing</a></li>
                <li><a href="{{ route('contact') }}" class="@if(request()->segment(1)=='contact') active @endif">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="{{ route('login.form') }}">Login</a>

    </div>
</header>
