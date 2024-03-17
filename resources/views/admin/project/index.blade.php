@extends('admin.layout.index')
@section('title', 'Quản lý Bài viết')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}">Bảng điều khiển</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Quản lý Bài viết</a>
            </li>
            <li class="breadcrumb-item active">Danh sách</li>
        </ol>
    </nav>
    <!-- Bảng Danh sách Bài viết -->
    <div class="card">
        <div class="px-3 pt-2">
            <x-notice />
        </div>
        <div class="card-header border-bottom d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">Quản lý Bài viết</h5>
            @can('create', App\Models\Project::class)
                <a href="{{ route('dashboard.projects.add') }}" class="btn btn-outline-primary">
                    <i class="fa-solid fa-plus"></i> &nbsp;Bài viết mới
                </a>
            @endcan
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-projects table border-top" id="projects-table">
                <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th style="width: 300px">Dự án</th>
                        <th>URL</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th style="width: 50px">Thao tác</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('#projects-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('dashboard.projects.list') !!}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'url',
                        name: 'url',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'category',
                        name: 'category',
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'deleted_at',
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [5,
                        'desc'
                    ] // 4 tương ứng với chỉ số của cột 'created_at' trong mảng 'columns'
                ],
                initComplete: function() {
                    // Tùy chỉnh vị trí placeholder cho ô tìm kiếm
                    $('#projects-table_filter input').attr('placeholder', 'Tìm kiếm');
                },
            });
        });
    </script>
@endsection
