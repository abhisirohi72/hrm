@extends('layouts.front.app')

@section('title', $main_title)

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="{{ asset('storage/themes/home/header') . '/' . $home_header->bg_img }}" alt="" class="hero-bg"
                data-aos="fade-in">

            <div class="container">
                <div class="row gy-4 d-flex justify-content-between">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up">{{ $home_header->title ?? '' }}</h2>
                        <p data-aos="fade-up" data-aos-delay="100">{{ $home_header->desc ?? '' }}</p>

                        <form action="#" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up"
                            data-aos-delay="200">
                            <input type="text" class="form-control" placeholder="Your ZIP code or City. e.g. New York">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>

                        <div class="row gy-4" data-aos="fade-up" data-aos-delay="300">
                            @foreach ($custom_col_name as $key => $data)
                                <div class="col-lg-3 col-6">
                                    <div class="stats-item text-center w-100 h-100">
                                        <span data-purecounter-start="0"
                                            data-purecounter-end="{{ $custom_col_value[$key] }}"
                                            data-purecounter-duration="0" data-key="{{ $key }}"
                                            class="purecounter">{{ $custom_col_value[$key] }}</span>
                                        <p>{{ $data }}</p>
                                    </div>
                                </div><!-- End Stats Item -->
                            @endforeach

                            {{-- <div class="col-lg-3 col-6">
                             <div class="stats-item text-center w-100 h-100">
                                 <span data-purecounter-start="0" data-purecounter-end="521"
                                     data-purecounter-duration="0" class="purecounter">521</span>
                                 <p>Projects</p>
                             </div>
                         </div><!-- End Stats Item -->

                         <div class="col-lg-3 col-6">
                             <div class="stats-item text-center w-100 h-100">
                                 <span data-purecounter-start="0" data-purecounter-end="1453"
                                     data-purecounter-duration="0" class="purecounter">1453</span>
                                 <p>Support</p>
                             </div>
                         </div><!-- End Stats Item -->

                         <div class="col-lg-3 col-6">
                             <div class="stats-item text-center w-100 h-100">
                                 <span data-purecounter-start="0" data-purecounter-end="32"
                                     data-purecounter-duration="0" class="purecounter">32</span>
                                 <p>Workers</p>
                             </div>
                         </div><!-- End Stats Item --> --}}

                        </div>

                    </div>

                    <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                        <img src="{{ asset('frontend/assets/img/hero-img.svg') }}" class="img-fluid mb-3 mb-lg-0"
                            alt="">
                    </div>

                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section">

            <div class="container">

                <div class="row gy-4">
                    @if (count($home_custom_data) > 0)
                        @foreach ($home_custom_data as $key => $data)
                            <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                                <div class="icon flex-shrink-0">
                                    {!! $data->icon !!}
                                </div>
                                <div>
                                    <h4 class="title">{{ $data->title }}</h4>
                                    <p class="description">{{ $data->desc }}</p>
                                    <a href="{{ $data->url }}" class="readmore stretched-link"><span>Learn More</span><i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <!-- End Service Item -->

                    {{-- <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon flex-shrink-0"><i class="fa-solid fa-truck"></i></div>
                        <div>
                            <h4 class="title">Dolor Sitema</h4>
                            <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat tarad limino ata</p>
                            <a href="#" class="readmore stretched-link"><span>Learn More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon flex-shrink-0"><i class="fa-solid fa-truck-ramp-box"></i></div>
                        <div>
                            <h4 class="title">Sed ut perspiciatis</h4>
                            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                dolore eu fugiat nulla pariatur</p>
                            <a href="#" class="readmore stretched-link"><span>Learn More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div><!-- End Service Item --> --}}

                </div>

            </div>

        </section><!-- /Featured Services Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up"
                        data-aos-delay="200">
                        @if ($home_about_us && $home_about_us[0]->video && $home_about_us[0]->video_image)
                            <img src="{{ asset('storage/themes/about_us') . '/' . $home_about_us[0]->video_image }}"
                                class="img-fluid" alt="">
                            <a href="{{ asset('storage/themes/about_us') . '/' . $home_about_us[0]->video }}"
                                class="glightbox pulsating-play-btn"></a>
                        @endif
                    </div>

                    <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
                        <h3>About Us</h3>
                        <p>
                            {{ $home_about_us[0]->desc }}
                        </p>
                        <ul>
                            @if ($home_about_us)
                                @foreach ($home_about_us as $key => $data)
                                    <li>
                                        {!! $data->icon !!}
                                        <div>
                                            <h5>{{ $data->title }}</h5>
                                            <p>{{ $data->s_desc }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                            {{-- <li>
                                <i class="bi bi-fullscreen-exit"></i>
                                <div>
                                    <h5>Magnam soluta odio exercitationem reprehenderi</h5>
                                    <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna pasata
                                        redi</p>
                                </div>
                            </li>
                            <li>
                                <i class="bi bi-broadcast"></i>
                                <div>
                                    <h5>Voluptatem et qui exercitationem</h5>
                                    <p>Et velit et eos maiores est tempora et quos dolorem autem tempora incidunt maxime
                                        veniam</p>
                                </div>
                            </li> --}}
                        </ul>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Our Services<br></span>
                <h2>Our ServiceS</h2>
                <p>{{ $home_service[0]->m_title }}</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    @if ($home_service)
                        @foreach ($home_service as $key => $data)
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="{{ asset('storage/themes/service') . '/' . $data->image }}"
                                            alt="" class="img-fluid">
                                    </div>
                                    <h3>{{ $data->title }}</h3>
                                    <p>{{ $data->desc }}</p>
                                </div>
                            </div><!-- End Card Item -->
                        @endforeach
                    @endif

                    {{-- <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('frontend/assets/img/service-2.jpg') }}" alt=""
                                    class="img-fluid">
                            </div>
                            <h3><a href="#" class="stretched-link">Logistics</a></h3>
                            <p>Asperiores provident dolor accusamus pariatur dolore nam id audantium ut et iure incidunt
                                molestiae dolor ipsam ducimus occaecati nisi</p>
                        </div>
                    </div><!-- End Card Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('frontend/assets/img/service-3.jpg') }}" alt=""
                                    class="img-fluid">
                            </div>
                            <h3><a href="#" class="stretched-link">Cargo</a></h3>
                            <p>Dicta quam similique quia architecto eos nisi aut ratione aut ipsum reiciendis sit
                                doloremque oluptatem aut et molestiae ut et nihil</p>
                        </div>
                    </div><!-- End Card Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('frontend/assets/img/service-4.jpg') }}" alt=""
                                    class="img-fluid">
                            </div>
                            <h3><a href="#" class="stretched-link">Trucking</a></h3>
                            <p>Dicta quam similique quia architecto eos nisi aut ratione aut ipsum reiciendis sit
                                doloremque oluptatem aut et molestiae ut et nihil</p>
                        </div>
                    </div><!-- End Card Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('frontend/assets/img/service-5.jpg') }}" alt=""
                                    class="img-fluid">
                            </div>
                            <h3>Packaging</h3>
                            <p>Illo consequuntur quisquam delectus praesentium modi dignissimos facere vel cum onsequuntur
                                maiores beatae consequatur magni voluptates</p>
                        </div>
                    </div><!-- End Card Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('frontend/assets/img/service-6.jpg') }}" alt=""
                                    class="img-fluid">
                            </div>
                            <h3><a href="#" class="stretched-link">Warehousing</a></h3>
                            <p>Quas assumenda non occaecati molestiae. In aut earum sed natus eatae in vero. Ab modi
                                quisquam aut nostrum unde et qui est non quo nulla</p>
                        </div>
                    </div><!-- End Card Item --> --}}

                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section dark-background">

            <img src="{{ asset('storage/themes/call_to_action') . '/' . $call_to_action[0]->bg_img }}" alt="">

            <div class="container">
                <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                    <div class="col-xl-10">
                        <div class="text-center">
                            <h3>{{ $call_to_action[0]->main_title }}</h3>
                            <p>{{ $call_to_action[0]->desc }}</p>
                            <a class="cta-btn" href="{{ $call_to_action[0]->url }}">Call To Action</a>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Call To Action Section -->

        <!-- Features Section -->
        <section id="features" class="features section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Features</span>
                <h2>{{ $features[0]->m_title }}</h2>
                <p>{{ $features[0]->s_desc }}</p>
            </div><!-- End Section Title -->

            <div class="container">
                @if ($features)
                    @foreach ($features as $key => $data)
                        <div class="row gy-4 align-items-center features-item">
                            <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
                                <img src="{{ asset('storage/themes/feature') . '/' . $data->image }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
                                <h3>{{ $data->title }}</h3>
                                {!! $data->desc !!}
                                {{-- <p class="fst-italic">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut
                                    labore et dolore
                                    magna aliqua.
                                </p>
                                <ul>
                                    <li><i class="bi bi-check"></i><span> Ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat.</span></li>
                                    <li><i class="bi bi-check"></i> <span>Duis aute irure dolor in reprehenderit in
                                            voluptate
                                            velit.</span></li>
                                    <li><i class="bi bi-check"></i> <span>Ullam est qui quos consequatur eos
                                            accusamus.</span>
                                    </li>
                                </ul> --}}
                            </div>
                        </div><!-- Features Item -->
                    @endforeach
                @endif

                {{-- <div class="row gy-4 align-items-center features-item">
                    <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out"
                        data-aos-delay="200">
                        <img src="{{ asset('frontend/assets/img/features-2.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="200">
                        <h3>Corporis temporibus maiores provident</h3>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore
                            magna aliqua.
                        </p>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                            in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum
                        </p>
                    </div>
                </div><!-- Features Item -->

                <div class="row gy-4 align-items-center features-item">
                    <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out">
                        <img src="{{ asset('frontend/assets/img/features-3.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7" data-aos="fade-up">
                        <h3>Sunt consequatur ad ut est nulla consectetur reiciendis animi voluptas</h3>
                        <p>Cupiditate placeat cupiditate placeat est ipsam culpa. Delectus quia minima quod. Sunt saepe
                            odit aut quia voluptatem hic voluptas dolor doloremque.</p>
                        <ul>
                            <li><i class="bi bi-check"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</span></li>
                            <li><i class="bi bi-check"></i><span> Duis aute irure dolor in reprehenderit in voluptate
                                    velit.</span></li>
                            <li><i class="bi bi-check"></i> <span>Facilis ut et voluptatem aperiam. Autem soluta ad
                                    fugiat</span>.</li>
                        </ul>
                    </div>
                </div><!-- Features Item -->

                <div class="row gy-4 align-items-center features-item">
                    <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out">
                        <img src="{{ asset('frontend/assets/img/features-4.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7 order-2 order-md-1" data-aos="fade-up">
                        <h3>Quas et necessitatibus eaque impedit ipsum animi consequatur incidunt in</h3>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore
                            magna aliqua.
                        </p>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                            in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum
                        </p>
                    </div>
                </div><!-- Features Item --> --}}

            </div>

        </section><!-- /Features Section -->

        <!-- Pricing Section -->
        <section id="pricing" class="pricing section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Pricing</span>
                <h2>{{ $pricing[0]->m_title ?? '' }}</h2>
                <p>{{ $pricing[0]->s_desc ?? '' }}</p>
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

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section dark-background">

            <img src="{{ asset('frontend/assets/img/testimonials-bg.jpg') }}" class="testimonials-bg" alt="">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('frontend/assets/img/testimonials/testimonials-1.jpg') }}"
                                    class="testimonial-img" alt="">
                                <h3>Saul Goodman</h3>
                                <h4>Ceo &amp; Founder</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                        rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                        risus at semper.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('frontend/assets/img/testimonials/testimonials-2.jpg') }}"
                                    class="testimonial-img" alt="">
                                <h3>Sara Wilsson</h3>
                                <h4>Designer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum
                                        quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure
                                        amet legam anim culpa.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('frontend/assets/img/testimonials/testimonials-3.jpg') }}"
                                    class="testimonial-img" alt="">
                                <h3>Jena Karlis</h3>
                                <h4>Store Owner</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                        veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint
                                        minim.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('frontend/assets/img/testimonials/testimonials-4.jpg') }}"
                                    class="testimonial-img" alt="">
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                        fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore
                                        quem dolore labore illum veniam.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('frontend/assets/img/testimonials/testimonials-5.jpg') }}"
                                    class="testimonial-img" alt="">
                                <h3>John Larson</h3>
                                <h4>Entrepreneur</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor
                                        noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam
                                        esse veniam culpa fore nisi cillum quid.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Testimonials Section -->

        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>{{ $faq[0]->m_title }}</span>
                <h2>{{ $faq[0]->m_title }}</h2>
                <p>{{ $faq[0]->s_desc }}</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10">

                        <div class="faq-container">
                            @if ($faq)
                                @foreach ($faq as $key => $data)
                                    <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                                        <i class="faq-icon bi bi-question-circle"></i>
                                        <h3>{{ $data->qst }}</h3>
                                        <div class="faq-content">
                                            <p>{{ $data->ans }}</p>
                                        </div>
                                        <i class="faq-toggle bi bi-chevron-right"></i>
                                    </div><!-- End Faq item-->
                                @endforeach
                            @endif
                            {{-- <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</h3>
                                <div class="faq-content">
                                    <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                                        velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend
                                        donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in
                                        cursus turpis massa tincidunt dui.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
                                <div class="faq-content">
                                    <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus
                                        pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit.
                                        Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis
                                        tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h3>
                                <div class="faq-content">
                                    <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                                        velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend
                                        donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in
                                        cursus turpis massa tincidunt dui.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</h3>
                                <div class="faq-content">
                                    <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in
                                        est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl
                                        suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item--> --}}

                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Faq Section -->

    </main>
@endsection
