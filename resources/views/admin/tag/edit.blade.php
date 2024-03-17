@extends('admin.layout.index')
@section('title', 'Cập nhật')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}">Bảng điều khiển</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);"> Đặc điểm</a>
            </li>
            <li class="breadcrumb-item active">{{ $characteristic->name }}</li>
        </ol>
    </nav>
    <form class="card" action="{{ route('dashboard.tags.update', $characteristic->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="card-body">
            <x-notice />

            <div class=" d-flex align-items-center justify-content-end">
                <a href="{{ route('dashboard.tags.index') }}" class="btn btn-outline-primary">
                    <i class='bx bx-list-ul'></i> &nbsp;Quản lý Đặc điểm
                </a>
            </div>
            <div class="row">
                <div class="mb-3 ">
                    <label class="form-label" for="name">Tên Đặc điểm: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') invalid @enderror"
                        value="{{ old('name') ?? $characteristic->name }}" name="name" id="name" autofocus>
                    @error('name')
                        <p class="text-danger mt-1 fs-6">{{ $message }}</p>
                    @enderror
                </div>



            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary ms-auto ">Lưu thay đổi</button>
            </div>
        </div>
    </form>
@endsection
