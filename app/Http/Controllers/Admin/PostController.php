<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.post.index');
    }

    public function list()
    {
        $posts = Post::select(['id', 'title', 'images',  'user_id', 'category_id', 'deleted_at', 'created_at']);
        $posts->withTrashed();
        return DataTables::of($posts)
            ->editColumn('title', function ($post) {
                return '
        <div class="d-flex justify-content-start align-items-center gap-2">
                <div class=" me-3">
                    <img src="' . (getThumb(explode(',', $post->images)[0])) . '" alt="image" class="w-px-50 h-px-50  rounded-3 object-fit-images">
                </div>
            <div class="d-flex flex-column">
                <strong title=" ' . $post->title . '"><a href="' . route('dashboard.posts.edit', $post->id) . '" class="text-body truncate-3" >
                     ' . $post->title . '
                </a></strong>
            </div>
        </div>';
            })
            ->editColumn('author', function ($post) {
                return '
            <div class="d-flex flex-column">
                <strong class="text-body text-truncate">
                    ' . $post->user->full_name . '
                </strong>
                <small class="text-muted">' . $post->user->email . '</small>
            </div>';
            })

            ->editColumn('status', function ($post) {
                return '<span class="badge me-1 ' . ($post->deleted_at == null ? 'bg-label-success' : 'bg-label-danger') . '">' . ($post->deleted_at == null ? 'Hoạt động' : 'Đình chỉ') . '</span>';
            })
            ->addColumn('actions', function ($post) {
                return '
    <div class="d-inline-block text-nowrap">
        <a href="' . route('dashboard.posts.edit', $post->id) . '" class="btn btn-sm btn-icon "><i class="bx bx-edit"></i></a>

        <button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
        <div class="dropdown-menu dropdown-menu-end m-0">
            <a href="' . route('dashboard.posts.edit', $post->id) . '" class="dropdown-item">Xem thêm</a>' .
                    (Auth::user()->group_id != 6 ? '<form action="' . ($post->trashed() == 1 ? route('dashboard.posts.restore', $post->id) : route('dashboard.posts.soft-delete', $post->id)) . '" class="dropdown-item" method="POST">' .
                        csrf_field() . '<button type="submit" class="btn p-0 w-100 justify-content-start" >' . ($post->trashed() == 1 ? "Hoạt động" : "Đình chỉ") . ' </button>
                </form>' : '') .
                    ($post->trashed() == 1 || Auth::user()->id == $post->user_id ? '<form action="' . route('dashboard.posts.force-delete', $post->id) . '" class="dropdown-item" method="POST" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa vĩnh viễn không?\')">' .
                        csrf_field() . '<button type="submit" class="btn p-0 w-100 justify-content-start" >Xóa vĩnh viễn </button>
                </form>' : '') . '
        </div>
    </div>';
            })

            ->editColumn('created_at', function ($post) {
                return '<p class="m-0">' . $post->created_at->format('d/m/Y') . '</p>
            <small>' . $post->created_at->format('h:i A') . '</small>';
            })
            ->rawColumns(['title', 'author', 'status', 'actions', 'created_at'])
            ->make();
    }


    public function add()
    {
        return view('admin.post.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255|unique:posts,title',
            'content' => 'required',
            'title_meta' => 'required',
            'description_meta' => 'required',
            'tags' => 'required',
            'images' => 'required',
            'category_id' => 'required',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'content.required' => 'Vui lòng nhập nội dung',
            'tags.required' => 'Vui lòng chọn đặc điểm',
            'images.required' => 'Bắt buộc phải thêm một hình làm ảnh bìa',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'title_meta.required' => 'Vui lòng thêm nội dung',
            'description_meta.required' => 'Vui lòng thêm nội dung',
        ]);

        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($request->title);

        $check = Post::insert($data);

        if ($check) {
            return back()->with('msgSuccess', 'Tạo mới thành công');
        }
        return back()->with('msgError', 'Tạo mới thất bại');
    }

    public function edit(Request $request, $id)
    {
        $post = Post::withTrashed()->find($id);

        if (!$post) {
            abort(404);
        }
        return view('admin.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|max:255|unique:posts,title,' . $id,
            'title_meta' => 'required',
            'description_meta' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'images' => 'required',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'content.required' => 'Vui lòng nhập nội dung',
            'tags.required' => 'Vui lòng chọn đặc điểm',
            'images.required' => 'Bắt buộc phải thêm một hình làm ảnh bìa',
            'title_meta.required' => 'Vui lòng thêm nội dung',
            'description_meta.required' => 'Vui lòng thêm nội dung',
        ]);

        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($request->title);

        $check = Post::withTrashed()->where('id', $id)->update($data);

        if ($check) {
            return back()->with('msgSuccess', 'Cập nhật thành công');
        }
        return back()->with('msgError', 'Cập nhật thất bại');
    }

    public function softDelete($id)
    {

        $check = Post::destroy($id);

        if ($check) {
            return back()->with('msgSuccess', 'Tạm dừng thành công');
        }
        return back()->with('msgError', 'Tạm dừng thất bại');
    }

    public function restore($id)
    {
        $check = Post::onlyTrashed()->where('id', $id)->restore();

        if ($check) {
            return back()->with('msgSuccess', 'Khôi phục thành công');
        }
        return back()->with('msgError', 'Khôi phục thất bại');
    }

    public function forceDelete($id)
    {

        $check = Post::onlyTrashed()->where('id', $id)->forceDelete();

        if ($check) {
            return back()->with('msgSuccess', 'Xóa thành công');
        }
        return back()->with('msgError', 'Xóa thất bại');
    }
}
