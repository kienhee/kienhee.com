@extends('client.layout.index')
@section('title', $post->title)
@section('seo')
    <!-- Primary Meta Tags -->
    <meta name="title" content="{{ $post->title_meta }}" />
    <meta name="description" content="{{ $post->description_meta }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ getEnv('APP_URL') }}" />
    <meta property="og:title" content="{{ $post->title_meta }}" />
    <meta property="og:description" content="{{ $post->description_meta }}" />
    <meta property="og:image" content="{{ getEnv('APP_URL') }}{{ $post->images }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ getEnv('APP_URL') }}" />
    <meta property="twitter:title" content="{{ $post->title_meta }}" />
    <meta property="twitter:description" content="{{ $post->description_meta }}" />
    <meta property="twitter:image" content="{{ getEnv('APP_URL') }}{{ $post->images }}" />
    <!-- Meta Tags Generated with https://metatags.io -->
@endsection
@section('content')
    <section class="wrapper">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if (session('msgSuccess'))
                    <div class="alert alert-success"
                        style="background-color: #e8fadf;border-color: #d4f5c3;color: #71dd37;">
                        {{ session('msgSuccess') }}
                    </div>
                @endif
                @if (session('msgError'))
                    <div class="alert alert-danger" style="background-color: #ffe0db;border-color: #ffc5bb;color: #ff3e1d;">
                        {{ session('msgError') }}
                    </div>
                @endif
                <div
                    class="sort py-2 d-flex gap-2 justify-content-between justify-content-lg-start align-items-center mb-3">
                    <a href="javascript:void(0)" onclick="window.history.back()" class="fw-medium text-secondary ">🔙
                        Quay lại</a>
                    <button class="btn btn-outline-dark btn-sm d-lg-none d-block" data-bs-toggle="offcanvas"
                        href="#categoryMobile" role="button" aria-controls="categoryMobile">
                        <i class="fa-solid fa-list"></i> Danh mục
                    </button>

                </div>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="categoryMobile"
                    aria-labelledby="categoryMobileLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="categoryMobileLabel">📂 Danh mục</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="category p-0">
                            <li>
                                <a class="category__item rounded-pill text-muted mb-2 d-block {{ empty(request()->query()) ? 'active' : '' }}"
                                    href="/">Tất cả</a>
                            </li>
                            @foreach (getAllCategories() as $category)
                                <li>
                                    <a href="/?category={{ $category->slug }}"
                                        class="category__item rounded-pill text-muted mb-2 d-block {{ request()->input('category') == $category->slug ? 'active' : '' }}"
                                        href="/">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="d-flex flex-column gap-3 mt-3">
                    <article class="article w-100 rounded-3  overflow-hidden">

                        @if ($post->images)
                            <img class="img-fluid" src="{{ $post->images }}" alt="{{ $post->title }}">
                        @endif
                        <div class="article__content p-2
                             p-md-3">
                            <h1 class="fs-3 fw-medium d-block mb-2">{{ $post->title }}</h1>
                            <small class="text-muted d-block mb-2">By <a
                                    href="{{ route('client.author') }}"><strong>{{ $post->user->full_name }}</strong></a>
                                -
                                <a
                                    href="/?category={{ $post->category->slug ?? '' }}">{{ $post->category->name ?? 'Danh mục ẩn' }}</a></small>
                            <small class="text-muted d-block mb-2">{{ $post->created_at->format('d/m/Y') }} -
                                {{ estimateReadingTime($post->content) }} phút đọc - <i class="fa-regular fa-eye"></i>
                                {{ $post->views }} views</small>
                            <hr>
                            <div>
                                {!! $post->content !!}
                            </div>
                            <div class="d-flex gap-2 flex-wrap mt-3 mb-4">
                                <span>🏷️ Tag:</span>
                                @foreach (json_decode($post->tags, true) as $tag)
                                    <a href="/?tag={{ $tag['value'] }}" class="tag">{{ $tag['value'] }}</a>
                                @endforeach
                            </div>
                            <hr>
                            <div class="social-button d-flex gap-3 align-items-center">
                                Chia sẻ:
                                <div class="social-icons d-flex gap-3 align-items-center fs-5">
                                    <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}"
                                        target="_blank"><i class="fa-brands fa-facebook"></i></a>
                                    <a href="http://twitter.com/share?text=Xem tôi tì được gì này." target="_blank"><i
                                            class="fa-brands fa-twitter"></i></a>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}"
                                        target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                                    <a href="mailto:?Subject=Xem tôi tì được gì này. {{ url()->current() }}"
                                        target="_blank"><i class="fa-regular fa-envelope"></i></a>
                                </div>
                            </div>

                            <hr>
                            <section class="p-1">


                                @foreach ($comments as $comment)
                                    <div class="d-flex flex-start mb-4">
                                        <img class="rounded-circle shadow-1-strong me-3 d-none d-md-block"
                                            src="{{ asset('client-frontend/images/facebook-avatar.png') }}" alt="avatar"
                                            width="65" height="65" style="object-fit: contain" />
                                        <div class="card w-100">
                                            <div class="card-body p-4">
                                                <div class="">
                                                    <img class="rounded-circle shadow-1-strong mb-2 d-md-none"
                                                        src="{{ asset('client-frontend/images/facebook-avatar.png') }}"
                                                        style="object-fit: contain" alt="avatar" width="65"
                                                        height="65" />
                                                    <h5>{{ $comment->name }}</h5>
                                                    <p class="small">
                                                        {{ $comment->created_at->format('d/m/Y') }}
                                                    </p>
                                                    <p>
                                                        {{ $comment->content }}
                                                    </p>

                                                    {{-- <div class="d-flex justify-content-end align-items-center">

                                                        <a href="#!" class="link-muted"><i
                                                                class="fas fa-reply me-1"></i>
                                                            Reply</a>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <hr class="mt-5">


                                <h5 class="title mb-4 mt-4 text-center">Để lại lời nhắn</h5>
                                <form action="{{ route('client.commentPost', $post->id) }}" method="POST"
                                    class="row mb-3">
                                    @csrf
                                    <div class="col-md-6 mb-3">
                                        <label for="fullName" class="form-label">Họ và tên
                                        </label>
                                        <input type="text" class="form-control" id="fullName" name="name"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <p class="text-danger my-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6  mb-3">
                                        <label for="email" class="form-label">Email
                                        </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <p class="text-danger my-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="comment" class="form-label">Nội dung</label>
                                        <textarea class="form-control" id="comment" name="content" rows="3" required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <p class="text-danger my-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100">Bình luận</button>
                                    </div>
                                </form>
                                <small class="d-block text-center text-muted d-lg-none">© kienhee.com 2022 -
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                </small>
                            </section>

                        </div>
                    </article>

                </div>
            </div>

        </div>
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
                    class="  d-block fw-medium d-flex align-items-center gap-2 ">
                    <i class="fa-solid fa-square-phone fs-5"></i><span>Telephone</span></a>
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
