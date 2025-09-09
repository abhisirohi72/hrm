@extends('layouts.front.app')

@section('title', $main_title)

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
            <div class="container position-relative">
                <h1>{{ $pricing[0]->m_title }}</h1>
                <p>{{ $pricing[0]->s_desc }}</p>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">Pricing</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Pricing Section -->
        <section id="pricing" class="pricing section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>{{ $pricing[0]->m_title }}</span>
                <h2>{{ $pricing[0]->m_title }}</h2>
                <p>{{ $pricing[0]->s_desc }}</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    @if ($pricing)
                        @foreach ($pricing as $key => $data)
                            <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                                <div class="pricing-item">
                                    <h3>{{ $data->title }}</h3>
                                    <h4><sup>$</sup>{{ $data->price }}<span> / month</span></h4>
                                    <ul>
                                        @php
                                            $points = json_decode($data->points, true);
                                        @endphp
                                        @foreach ($points as $point)
                                            <li><i class="bi bi-check"></i> <span>{{ $point }}</span></li>
                                        @endforeach
                                    </ul>
                                    <a href="#" class="buy-btn">Buy Now</a>
                                </div>
                            </div><!-- End Pricing Item -->
                        @endforeach
                    @endif

                    {{-- <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="pricing-item featured">
                            <h3>Business Plan</h3>
                            <h4><sup>$</sup>29<span> / month</span></h4>
                            <ul>
                                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                                <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
                                <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
                            </ul>
                            <a href="#" class="buy-btn">Buy Now</a>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="pricing-item">
                            <h3>Developer Plan</h3>
                            <h4><sup>$</sup>49<span> / month</span></h4>
                            <ul>
                                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                                <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
                                <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
                            </ul>
                            <a href="#" class="buy-btn">Buy Now</a>
                        </div>
                    </div><!-- End Pricing Item --> --}}

                </div>

            </div>

        </section><!-- /Pricing Section -->

        <!-- Alt Pricing Section -->
        <section id="alt-pricing" class="alt-pricing section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Alt Pricing<br></span>
                <h2>Alt Pricing</h2>
                <p>{{ $pricing[0]->s_desc }}</p>
            </div><!-- End Section Title -->

            <div class="container">
                @if ($pricing)
                    @foreach ($pricing as $key => $data)
                        <div class="row gy-4 pricing-item {{ $key % 2 }} @if ($key != 0 && $key % 2 != '') featured @endif"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="col-lg-3 d-flex align-items-center justify-content-center">
                                <h3>{{ $data->title }}</h3>
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-center">
                                <h4><sup>$</sup>{{ $data->price }}<span> / month</span></h4>
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-center">
                                <ul>
                                    @php
                                        $points = json_decode($data->points, true);
                                    @endphp
                                    @foreach ($points as $point)
                                        <li><i class="bi bi-check"></i> <span>{{ $point }}</span></li>
                                    @endforeach
                                    {{-- <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                                    <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                                    <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span>
                                    </li> --}}
                                </ul>
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-center">
                                <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                            </div>
                        </div><!-- End Pricing Item -->
                    @endforeach
                @endif

                {{-- <div class="row gy-4 pricing-item featured mt-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-3 d-flex align-items-center justify-content-center">
                        <h3>Business Plan</h3>
                    </div>
                    <div class="col-lg-3 d-flex align-items-center justify-content-center">
                        <h4><sup>$</sup>29<span> / month</span></h4>
                    </div>
                    <div class="col-lg-3 d-flex align-items-center justify-content-center">
                        <ul>
                            <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                            <li><i class="bi bi-check"></i> <strong>Nec feugiat nisl pretium</strong></li>
                            <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 d-flex align-items-center justify-content-center">
                        <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="row gy-4 pricing-item mt-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="col-lg-3 d-flex align-items-center justify-content-center">
                        <h3>Developer Plan</h3>
                    </div>
                    <div class="col-lg-3 d-flex align-items-center justify-content-center">
                        <h4><sup>$</sup>49<span> / month</span></h4>
                    </div>
                    <div class="col-lg-3 d-flex align-items-center justify-content-center">
                        <ul>
                            <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                            <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                            <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 d-flex align-items-center justify-content-center">
                        <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                    </div>
                </div><!-- End Pricing Item --> --}}

            </div>

        </section><!-- /Alt Pricing Section -->

    </main>
@endsection
