@extends('layouts.front.app')

@section('title', $main_title)

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade"
            style="background-image: url({{ asset('storage/themes/about_us') . '/' . $home_about_us[0]->video_image }});">
            <div class="container position-relative">
                <h1>About</h1>
                <p>{{ $home_about_us[0]->desc }}</p>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">About</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up"
                        data-aos-delay="200">
                        <img src="{{ asset('storage/themes/about_us') . '/' . $home_about_us[0]->video_image }}"
                            class="img-fluid" alt>
                        <a href="{{ asset('storage/themes/about_us') . '/' . $home_about_us[0]->video }}"
                            class="glightbox pulsating-play-btn"></a>
                    </div>

                    <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
                        <h3>About Us</h3>
                        <p>{{ $home_about_us[0]->desc }}</p>
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
                                    <p>Quo totam dolorum at pariatur aut distinctio dolorum
                                        laudantium illo direna pasata redi</p>
                                </div>
                            </li>
                            <li>
                                <i class="bi bi-broadcast"></i>
                                <div>
                                    <h5>Voluptatem et qui exercitationem</h5>
                                    <p>Et velit et eos maiores est tempora et quos dolorem autem
                                        tempora incidunt maxime veniam</p>
                                </div>
                            </li> --}}
                        </ul>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    @foreach ($custom_col_name as $key => $data)
                        <div class="col-lg-3 col-6">
                            <div class="stats-item text-center w-100 h-100">
                                <span data-purecounter-start="0" data-purecounter-end="{{ $custom_col_value[$key] }}"
                                    data-purecounter-duration="0" data-key="{{ $key }}"
                                    class="purecounter">{{ $custom_col_value[$key] }}</span>
                                <p>{{ $data }}</p>
                            </div>
                        </div><!-- End Stats Item -->
                    @endforeach

                    {{-- <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Projects</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Hours Of Support</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Workers</p>
                        </div>
                    </div><!-- End Stats Item --> --}}

                </div>

            </div>

        </section><!-- /Stats Section -->

        <!-- Team Section -->
        <section id="team" class="team section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>{{ $team[0]->title }}<br></span>
                <h2>{{ $team[0]->title }}</h2>
                <p>{{ $team[0]->desc }}</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row">
                    @if ($team)
                        @foreach ($team as $key => $data)
                            <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                    <img src="{{ asset('storage/themes/teams') . '/' . $data->image }}" class="img-fluid" alt>
                                    <div class="member-content">
                                        <h4>{{ $data->name }}</h4>
                                        <span>{{ $data->designtaion }}</span>
                                        <p>
                                            {{ $data->s_desc }}
                                        </p>
                                        <div class="social">
                                            <a href="{{ $data->t_url }}"><i class="bi bi-twitter-x"></i></a>
                                            <a href="{{ $data->fb_url }}"><i class="bi bi-facebook"></i></a>
                                            <a href="{{ $data->insta_url }}"><i class="bi bi-instagram"></i></a>
                                            <a href="{{ $data->linkedin_url }}"><i class="bi bi-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Team Member -->
                        @endforeach
                    @endif


                    {{-- <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <img src="assets/img/team/team-2.jpg" class="img-fluid" alt>
                            <div class="member-content">
                                <h4>Sarah Jhinson</h4>
                                <span>Marketing</span>
                                <p>
                                    Repellat fugiat adipisci nemo illum nesciunt voluptas
                                    repellendus. In architecto rerum rerum temporibus
                                </p>
                                <div class="social">
                                    <a href><i class="bi bi-twitter-x"></i></a>
                                    <a href><i class="bi bi-facebook"></i></a>
                                    <a href><i class="bi bi-instagram"></i></a>
                                    <a href><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="member">
                            <img src="assets/img/team/team-3.jpg" class="img-fluid" alt>
                            <div class="member-content">
                                <h4>William Anderson</h4>
                                <span>Content</span>
                                <p>
                                    Voluptas necessitatibus occaecati quia. Earum totam
                                    consequuntur qui porro et laborum toro des clara
                                </p>
                                <div class="social">
                                    <a href><i class="bi bi-twitter-x"></i></a>
                                    <a href><i class="bi bi-facebook"></i></a>
                                    <a href><i class="bi bi-instagram"></i></a>
                                    <a href><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member --> --}}

                </div>

            </div>

        </section><!-- /Team Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section dark-background">

            <img src="{{ asset('frontend/assets/img/testimonials-bg.jpg')}}" class="testimonials-bg" alt>

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
                                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt>
                                <h3>Saul Goodman</h3>
                                <h4>Ceo &amp; Founder</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Proin iaculis purus consequat sem cure digni ssim
                                        donec porttitora entum suscipit rhoncus. Accusantium quam,
                                        ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                        risus at semper.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt>
                                <h3>Sara Wilsson</h3>
                                <h4>Designer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Export tempor illum tamen malis malis eram quae irure
                                        esse labore quem cillum quid cillum eram malis quorum
                                        velit fore eram velit sunt aliqua noster fugiat irure amet
                                        legam anim culpa.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt>
                                <h3>Jena Karlis</h3>
                                <h4>Store Owner</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Enim nisi quem export duis labore cillum quae magna
                                        enim sint quorum nulla quem veniam duis minim tempor
                                        labore quem eram duis noster aute amet eram fore quis sint
                                        minim.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt>
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Fugiat enim eram quae cillum dolore dolor amet nulla
                                        culpa multos export minim fugiat minim velit minim dolor
                                        enim duis veniam ipsum anim magna sunt elit fore quem
                                        dolore labore illum veniam.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt>
                                <h3>John Larson</h3>
                                <h4>Entrepreneur</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Quis quorum aliqua sint quem legam fore sunt eram
                                        irure aliqua veniam tempor noster veniam enim culpa labore
                                        duis sunt culpa nulla illum cillum fugiat legam esse
                                        veniam culpa fore nisi cillum quid.</span>
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
