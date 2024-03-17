<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'KienTran🔥')</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('client-frontend') }}/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('client-frontend') }}/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('client-frontend') }}/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('client-frontend') }}/images/favicon/site.webmanifest">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('client-frontend') }}/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('client-frontend') }}/lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('client-frontend') }}/lib/owlcarousel/assets/owl.carousel.min.css">
    <script src="https://cdn.tiny.cloud/1/el9eht3oqsjlpvjkdu2mx5gh01fq5xie6zt09pq791iqfhej/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('client-frontend') }}/lib/prismjs/prism.css">
    <link rel="stylesheet" href="{{ asset('client/assets/lib/lightbox/dist/css/lightbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
        integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('client-frontend') }}/css/style.css">
    @yield('seo')
</head>
<body>
    <header class="header py-2 shadow-sm mb-5">
        <div class="wrapper">
            <nav class="d-flex justify-content-between align-items-center">
                <a href="/" class="fw-medium text-uppercase d-flex align-items-center gap-2"> <img
                        src="{{ asset('client-frontend') }}/images/favicon/favicon-32x32.png"
                        alt="Trần Trung Kiên"><span>Kienhee</span></a>
                <a href="{{ route('client.author') }}" class="fw-medium">Tác giả</a>
            </nav>
        </div>
    </header>
    <main class="main">
        @yield('content')
    </main>
    <script src="{{ asset('client-frontend') }}/lib/jquery.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="{{ asset('client-frontend') }}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('client-frontend') }}/lib/isotope/isotope-min.js"></script>
    <script src="{{ asset('client-frontend') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('client-frontend') }}/lib/prismjs/prism.js"></script>
    <script src="{{ asset('client/assets/lib/lightbox/dist/js/lightbox.min.js') }}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
        integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('client-frontend') }}/js/main.js"></script>
    @yield('script')
</body>

</html>
