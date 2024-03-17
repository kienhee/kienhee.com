@extends('admin.layout.index')
@section('title', 'Thêm bài viết mới')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}">Bảng điều khiển</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Quản lý bài viết</a>
            </li>
            <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
    </nav>
    <form class="row" action="{{ route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="px-3 pt-2">
                    <x-notice />
                </div>
                <div class="card-header">
                    <h5 class="card-tile mb-0">Thông tin bài viết</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="title">Tiêu đề bài đăng: <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control  @error('title') invalid @enderror" id="title"
                            placeholder="Tiêu đề bài đăng" name="title" value="{{ old('title') }}"
                            aria-label="Tiêu đề bài đăng" autofocus />
                        @error('title')
                            <p class="text-danger mt-1 fs-6">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="content">Nội dung bài đăng: <span
                                class="text-danger">*</span></label>
                        <textarea name="content" id="content" class="my-editor @error('content') is-invalid @enderror" cols="50"
                            rows="30">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-danger mt-1 fs-6">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Ảnh bìa:<span class="text-danger">*</span></label>
                        <div class="upload__box">
                            <label data-input="thumbnail1" data-preview="holder1"
                                class="upload form-label upload-label mb-3">
                                <p class="mb-0">Tải ảnh lên</p>
                                <small>(Click vào đây)</small>
                            </label>

                            <input id="thumbnail1" class="form-control" type="text" name="images" hidden multiple>
                            <div id="holder1" class="d-flex justify-content-center gap-3 flex-wrap">
                                @if (old('images'))
                                    @foreach (explode(',', old('images')) as $item)
                                        <img src="{{ $item }}" class="img-fluid">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @error('images')
                            <p class="text-danger my-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>


        </div>

        <div class="col-12 col-lg-4">
            <div class="card mb-4">

                <div class=" card-header d-flex align-items-center justify-content-between ">
                    <h5 class="card-title mb-0">Thông tin</h5>
                    <a href="{{ route('dashboard.posts.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class='bx bx-list-ul'></i> &nbsp;Danh sách bài viết
                    </a>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="title_meta">Tiêu đề(SEO): <span class="text-danger">*</span></label>
                        <input type="text" class="form-control  @error('title_meta') invalid @enderror" id="title_meta"
                            placeholder="Tiêu đề(SEO)" name="title_meta" value="{{ old('title_meta') }}"
                            aria-label="Tiêu đề(SEO)" />
                        @error('title_meta')
                            <p class="text-danger mt-1 fs-6">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="description_meta">Mô tả(SEO): <span
                                class="text-danger">*</span></label>
                        <textarea name="description_meta" id="description_meta"
                            class="form-control  @error('description_meta') invalid @enderror" placeholder="Mô tả(SEO)" rows="5">{{ old('description_meta') }}</textarea>

                        @error('description_meta')
                            <p class="text-danger mt-1 fs-6">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 ">
                        <label for="category_id" class="form-label">Thuộc danh mục: <span
                                class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                            id="category_id">
                            <option value="">Vui lòng lựa chọn</option>
                            @foreach (getAllCategoriesPost() as $item)
                                <option value="{{ $item->id }}"
                                    @if (old('category_id') == $item->id) @selected(true) @endif>
                                    {{ $item->name }}</option>
                            @endforeach


                        </select>
                        @error('category_id')
                            <p class="text-danger my-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class=" mb-4">
                        <label for="tags" class="form-label">Tags: <span class="text-danger">*</span></label>
                        <input id="tags" name="tags" class="form-control  @error('tags') is-invalid @enderror"
                            placeholder="Mặt phố, ô tô,  kinh doanh,..v.v" />
                        @error('tags')
                            <p class="text-danger mt-1 fs-6">{{ $message }}</p>
                        @enderror
                        <input type="hidden" value="{{ tags() }}" id="tagsData">

                    </div>

                    <button class="btn btn-primary w-100">Đăng bài</button>
                </div>
            </div>


        </div>

    </form>
@endsection
@section('script')
    <script src="/vendor/laravel-filemanager/js/upload-images-post.js"></script>
    <script>
        $('.upload').filemanager('image');
        const tags = document.querySelector('#tags');
        const whitelist = JSON.parse($('#tagsData').val())
        // Inline
        new Tagify(tags, {
            whitelist: whitelist,
            maxTags: 10,
            dropdown: {
                maxItems: 20,
                classname: 'tags-inline',
                enabled: 0,
                closeOnSelect: false
            }
        });
    </script>
@endsection
