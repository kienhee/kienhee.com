@extends('client.layout.index')
@section('title', 'Tác giả')
@section('seo')
    <!-- Primary Meta Tags -->
    <meta name="title" content="Trần Trung Kiên - Thông tin tác giả." />
    <meta name="description"
        content="Khám phá những bài viết hữu ích về kinh nghiệm lập trình, học lập trình từ cơ bản đến nâng cao, và cách giải quyết những thách thức thường gặp trong quá trình phát triển phần mềm." />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ getEnv('APP_URL') }}" />
    <meta property="og:title" content="Trần Trung Kiên - Thông tin tác giả." />
    <meta property="og:description"
        content="Khám phá những bài viết hữu ích về kinh nghiệm lập trình, học lập trình từ cơ bản đến nâng cao, và cách giải quyết những thách thức thường gặp trong quá trình phát triển phần mềm." />
    <meta property="og:image" content="{{ getEnv('APP_URL') }}/client/assets/images/about_img.jpg" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ getEnv('APP_URL') }}" />
    <meta property="twitter:title" content="Trần Trung Kiên - Thông tin tác giả." />
    <meta property="twitter:description"
        content="Khám phá những bài viết hữu ích về kinh nghiệm lập trình, học lập trình từ cơ bản đến nâng cao, và cách giải quyết những thách thức thường gặp trong quá trình phát triển phần mềm." />
    <meta property="twitter:image" content="{{ getEnv('APP_URL') }}/client/assets/images/about_img.jpg" />

    <!-- Meta Tags Generated with https://metatags.io -->
@endsection
@section('content')
    <section class="wrapper overflow-hidden">
        <section class="row ">
            <div class="col-md-6 ">
                <article>
                    <h2 class="text-uppercase">The Inception of Triumph</h2>
                    <hr>
                    <h4><span class="fs-2 text-muted">"</span> Trái tim như cây cầu, nối liền giấc mơ và hiện thực.
                        Sống đầy ý nghĩa, bước đi trên hành trình vô tận.<span class="fs-2 text-muted">"</span></h4>
                    <p>
                        Chào bạn 👋! Mình là <a href="https://www.facebook.com/kien.itt/" target="_blank"
                            class="text-primary">Trần Trung Kiên</a>, một Software Developer 🧑‍💻 và cũng là một người đam
                        mê
                        công nghệ. Với 2 năm kinh nghiệm trong ngành lập trình,
                        mình đang hướng tới sự sáng tạo và khám phá trong thế giới số. Ngoài ra, mình còn yêu thích
                        công việc viết blog, nhằm mục đích chia sẻ những kiến thức mà mình đã tích luỹ được trong
                        quá trình làm việc của mình tới mọi người🔥.
                    </p>
                </article>
            </div>
            <div class=" col-md-6 p-3">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('client-frontend') }}/images/about_img.jpg" alt="">
                        </div>
                        <div class="swiper-slide"><img src="{{ asset('client-frontend') }}/images/about_img3.jpg"
                                alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('client-frontend') }}/images/about_img2.jpg"
                                alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('client-frontend') }}/images/about_img4.jpg"
                                alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('client-frontend') }}/images/about_img5.jpg"
                                alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('client-frontend') }}/images/about_img2.jpg"
                                alt=""></div>
                    </div>
                </div>
            </div>
        </section>
        </div>
        {{-- <section class="py-5">
            <div class="section-title position-relative text-center mb-5 pb-2  ">
                <h6 class="position-relative d-inline text-primary ps-4">Sự nghiệp</h6>
                <h3 class="mt-2">Theo dòng sự kiện</h3>
            </div>
            <section class="design-section">

                <div class="timeline">

                    <div class="timeline-empty">
                    </div>

                    <div class="timeline-middle ">
                        <div class="timeline-circle "></div>
                    </div>
                    <div class="timeline-component timeline-content rounded-2 shadow-sm bg-white" data-aos="fade-left" data-aos-duration="1000">
                        <h3>2020 - 2021 🔥</h3>
                        <p>
                            - Theo học tại <strong>Trường Cao đẳng FPT Polytechnic</strong> Và <strong>Học viện công
                                nghệ thông tin T3H</strong> với chuyên ngành lập trình và design UI/UX.

                        </p>
                        <p>- Làm freelancer triển khai hơn <strong>30+</strong> các bài tập lớn, đồ án về lập trình.
                        </p>
                    </div>
                    <div class="timeline-component timeline-content rounded-2 shadow-sm bg-white" data-aos="fade-right" data-aos-duration="2000">
                        <h3>2022 🔥</h3>
                        <p>
                            - Giảng dạy và phát triển phần mềm tại <a href="https://rikkei.edu.vn/"
                                class="text-primary">Rikkei
                                Academy</a>
                        </p>
                        <p>
                            - Giảng dạy bộ môn Javascript và Reactjs.
                        </p>
                        <p>
                            - Thiết kế và phát triển phần mềm CMS, LMS và CRM.
                        </p>
                        <p>- Làm freelancer triển khai hơn <strong>50+</strong> các bài tập lớn, đồ án về lập trình.
                        </p>
                    </div>
                    <div class="timeline-middle ">
                        <div class="timeline-circle "></div>
                    </div>
                    <div class="timeline-empty">
                    </div>

                    <div class="timeline-empty">
                    </div>

                    <div class="timeline-middle ">
                        <div class="timeline-circle "></div>
                    </div>
                    <div class=" timeline-component timeline-content rounded-2 shadow-sm bg-white" data-aos="fade-left" data-aos-duration="3000">
                        <h3>2023 🔥</h3>
                        <p>
                            - Trở thành freelancer 🧑‍💻.
                        </p>
                        <p>
                            - Thiết kế và phát triển phần mềm CMS, LMS và CRM.
                        </p>
                        <p>
                            - Triển khai các ứng dụng web cho doanh nghiệp, cá nhân với hơn <strong>50+</strong>
                            khách hàng.
                        </p>
                    </div>

                </div>
            </section>
        </section> --}}


        <section class="py-5">
            <div class="section-title position-relative text-center mb-5 pb-2  ">
                <h6 class="position-relative d-inline text-primary ps-4">Dịch vụ</h6>
                <h3 class="mt-2">Những dịch vụ nào đang được mình triển khai?</h3>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 " data-aos="fade-up" data-aos-duration="1000">
                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <img src="{{ asset('client-frontend') }}/images/icons/customSoftware.png" alt="">
                        </div>
                        <h5 class="mb-3">Phát triển ứng dụng web</h5>
                        <p>Cung cấp dịch vụ phát triển ứng dụng web giúp doanh nghiệp, cá nhân bằng cách phát triển
                            Các
                            ứng dụng web
                            hiệu suất
                            cao và an
                            toàn.</p>
                        <a class=" mt-auto mx-auto" href=""></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 "data-aos="fade-up" data-aos-duration="5000">
                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <img src="{{ asset('client-frontend') }}/images/icons/mobile-development.png" alt="">
                        </div>
                        <h5 class="mb-3">Phát triển ứng dụng mobile</h5>
                        <p>Các ứng dụng di động sáng tạo, an toàn và đáng tin cậy cho trải nghiệm liền mạch.</p>
                        <a class=" mt-auto mx-auto" href=""></a>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 " data-aos="fade-up" data-aos-duration="1000">
                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <img src="{{ asset('client-frontend') }}/images/icons/ux-design.png" alt="">
                        </div>
                        <h5 class="mb-3">UI / UX Desgin</h5>
                        <p>Thiết kế trực quan, hấp dẫn và thân thiện với người dùng để tạo ra trải
                            nghiệm kỹ thuật
                            số
                            tuyệt vời và nâng
                            cao giá trị thương hiệu.</p>
                        <a class=" mt-auto mx-auto" href=""></a>
                    </div>
                </div>


            </div>
        </section>
        <section class="wrapper py-5 mb-4">
            <div class="section-title position-relative text-center  mb-5 pb-2  ">
                <h6 class="position-relative d-inline text-primary ps-4">Công nghệ</h6>
                <h3 class="mt-2">Công nghệ được sử dụng để cung cấp dịch vụ của mình ?
                </h3>
            </div>
            <div class="row technology gap-4 justify-content-center">
                <div
                    class="  col-md-3 col-lg-2 technology__item shadow-sm p-5 d-flex justify-content-center align-items-center  rounded-4">
                    <img src="{{ asset('client-frontend') }}/images/logo/nodejs.png" class="technology__img"
                        alt="">
                </div>
                <div
                    class="  col-md-3 col-lg-2 technology__item shadow-sm p-5 d-flex justify-content-center align-items-center  rounded-4">
                    <img src="{{ asset('client-frontend') }}/images/logo/reactjs.png" class="technology__img"
                        alt="">
                </div>
                <div
                    class="  col-md-3 col-lg-2 technology__item shadow-sm p-5 d-flex justify-content-center align-items-center  rounded-4">
                    <img src="{{ asset('client-frontend') }}/images/logo/java.png" class="technology__img"
                        alt="">
                </div>
                <div
                    class="  col-md-3 col-lg-2 technology__item shadow-sm p-5 d-flex justify-content-center align-items-center  rounded-4">
                    <img src="{{ asset('client-frontend') }}/images/logo/php.png" class="technology__img"
                        alt="">
                </div>
                <div
                    class="  col-md-3 col-lg-2 technology__item shadow-sm p-5 d-flex justify-content-center align-items-center  rounded-4">
                    <img src="{{ asset('client-frontend') }}/images/logo/laravel.png" class="technology__img"
                        alt="">
                </div>
                <div
                    class="  col-md-3 col-lg-2 technology__item shadow-sm p-5 d-flex justify-content-center align-items-center  rounded-4">
                    <img src="{{ asset('client-frontend') }}/images/logo/wordpress.png" class="technology__img"
                        alt="">
                </div>
                <div
                    class="  col-md-3 col-lg-2 technology__item shadow-sm p-5 d-flex justify-content-center align-items-center  rounded-4">
                    <img src="{{ asset('client-frontend') }}/images/logo/flutter.png" class="technology__img"
                        alt="">
                </div>
                <div
                    class="  col-md-3 col-lg-2 technology__item shadow-sm p-5 d-flex justify-content-center align-items-center  rounded-4">
                    <img src="{{ asset('client-frontend') }}/images/logo/chatgpt.png" class="technology__img"
                        alt="">
                </div>
                <div
                    class="  col-md-3 col-lg-2 technology__item shadow-sm p-5 d-flex justify-content-center align-items-center  rounded-4">
                    <img src="{{ asset('client-frontend') }}/images/logo/figma.png" class="technology__img"
                        alt="">
                </div>

            </div>
        </section>
        <section class="portfolio_area section_gap_top py-5" id="portfolio">
            <div class="section-title position-relative text-center  mb-5 pb-2  ">
                <h6 class="position-relative d-inline text-primary ps-4">Dự án</h6>
                <h3 class="mt-2">Một vài dự án được mình triển khai gần đây.
                </h3>
            </div>
            <div class="filters portfolio-filter">
                <ul>
                    <li class="active" data-filter="*">all</li>
                    @foreach ($categories as $category)
                        <li data-filter=".{{ createSlug($category->name) }}">{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="filters-content">
                <div class="row portfolio-grid justify-content-center">
                    @foreach ($projects as $project)
                        <div class="col-lg-4 col-md-6 all {{ createSlug($project->category->name) }}">
                            <div class="portfolio_box">
                                <div class="single_portfolio">
                                    <img class="img-fluid w-100" src="{{ explode(',', $project->images)[0] }}"
                                        alt="">
                                    <div class="overlay"></div>
                                    <a href="{{ route('client.work', $project->slug) }}">
                                        <div class="icon">
                                            <button class="btn bg-white rounded-pill ">Xem thêm</button>
                                        </div>
                                    </a>
                                </div>
                                <div class="short_info">
                                    <h4><a href="{{ route('client.work', $project->slug) }}">{{ $project->title }}</a>
                                    </h4>
                                    <p class="text-muted">{{ $project->category->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
        </section>
        {{-- <section class=" wrapper py-5">
            <div class="section-title position-relative  mb-5 pb-2  " style="max-width: 580px;">
                <h6 class="position-relative d-inline text-primary ps-4">Feedback </h6>
                <h3 class="mt-2">Khách hàng nói gì về dịch vụ của mình!
                </h3>
            </div>
            <div class="owl-carousel testimonial-carousel  ">

                @foreach ($feedbacks as $feedback)
                    <div class="testimonial-item rounded p-4 p-lg-5 mb-5">
                        <img class="mb-4" src="{{ $feedback->avatar }}" alt="">
                        <p class="mb-4">{{ $feedback->feedback }}</p>
                        <h5>{{ $feedback->name }}</h5>
                        <span class="text-primary ">{{ $feedback->career }}</span>
                        <div class="d-flex gap-1 mt-2">
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star text-warning"></span>
                        </div>
                    </div>
                @endforeach

            </div>

        </section> --}}
    </section>
    <footer class="py-5  bg-dark text-white">
        <div class=" d-flex justify-content-center gap-3">
            @if (author()->facebook)
                <a href="{{ author()->facebook }}" target="_blank"
                    class="  d-block fw-medium d-flex align-items-center gap-2 ">
                    <i class="fa-brands fa-facebook fs-5"></i><span>Facebook</span></a>
            @endif
            @if (author()->instagram)
                <a href="{{ author()->instagram }}" target="_blank"
                    class="  d-block fw-medium d-flex align-items-center gap-2 ">
                    <i class="fa-brands fa-instagram fs-5"></i><span>Instagram</span></a>
            @endif
            @if (author()->email)
                <a href="{{ author()->email }}" target="_blank"
                    class="  d-block fw-medium d-flex align-items-center gap-2 ">
                    <i class="fa-regular fa-envelope fs-5"></i><span>Email</span></a>
            @endif
            @if (author()->linkedin)
                <a href="{{ author()->linkedin }}" target="_blank"
                    class="  d-block fw-medium d-flex align-items-center gap-2 ">
                    <i class="fa-brands fa-linkedin fs-5"></i><span>Linkedin</span></a>
            @endif
            @if (author()->phone)
                <a href="tel:{{ author()->phone }}" target="_blank"
                    class=" d-block fw-medium d-flex align-items-center gap-2 ">
                    <i class="fa-solid fa-square-phone fs-5"></i></i><span>Telephone</span></a>
            @endif


        </div>
        <hr>
        <small class="d-block text-center ">© kienhee.com 2022 -
            <script>
                document.write(new Date().getFullYear())
            </script>
        </small>
    </footer>
@endsection
