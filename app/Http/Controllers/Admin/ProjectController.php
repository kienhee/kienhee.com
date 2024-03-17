<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.project.index');
    }

    public function list()
    {
        $projects = Project::select(['id', 'title', 'images', 'url', 'category_id', 'deleted_at', 'created_at']);
        $projects->withTrashed();
        return DataTables::of($projects)
            ->editColumn('title', function ($project) {
                return '
        <div class="d-flex justify-content-start align-items-center gap-2">
                <div class=" me-3">
                    <img src="' . (getThumb(explode(',', $project->images)[0])) . '" alt="image" class="w-px-50 h-px-50  rounded-3 object-fit-images">
                </div>
            <div class="d-flex flex-column">
                <strong title=" ' . $project->title . '"><a href="' . route('dashboard.projects.edit', $project->id) . '" class="text-body truncate-3" >
                     ' . $project->title . '
                </a></strong>
            </div>
        </div>';
            })
            ->editColumn('status', function ($post) {
                return '<span class="badge me-1 ' . ($post->deleted_at == null ? 'bg-label-success' : 'bg-label-danger') . '">' . ($post->deleted_at == null ? 'Hoạt động' : 'Đình chỉ') . '</span>';
            })
            ->editColumn('url', function ($project) {
                return '<a href="' . $project->url . '">' . $project->url . '</a>
            ';
            })

            ->editColumn('category', function ($project) {
                return '<span class="badge me-1 bg-label-success">' . $project->category->name  . '</span>';
            })
            ->addColumn('actions', function ($project) {
                return '
    <div class="d-inline-block text-nowrap">
        <a href="' . route('dashboard.projects.edit', $project->id) . '" class="btn btn-sm btn-icon "><i class="bx bx-edit"></i></a>

        <button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
        <div class="dropdown-menu dropdown-menu-end m-0">
            <a href="' . route('dashboard.projects.edit', $project->id) . '" class="dropdown-item">Xem thêm</a>' .
                    (Auth::user()->group_id != 6 ? '<form action="' . ($project->trashed() == 1 ? route('dashboard.projects.restore', $project->id) : route('dashboard.projects.soft-delete', $project->id)) . '" class="dropdown-item" method="POST">' .
                        csrf_field() . '<button type="submit" class="btn p-0 w-100 justify-content-start" >' . ($project->trashed() == 1 ? "Hoạt động" : "Đình chỉ") . ' </button>
                </form>' : '') .
                    ($project->trashed() == 1 || Auth::user()->id == $project->user_id ? '<form action="' . route('dashboard.projects.force-delete', $project->id) . '" class="dropdown-item" method="POST" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa vĩnh viễn không?\')">' .
                        csrf_field() . '<button type="submit" class="btn p-0 w-100 justify-content-start" >Xóa vĩnh viễn </button>
                </form>' : '') . '
        </div>
    </div>';
            })

            ->editColumn('created_at', function ($project) {
                return '<p class="m-0">' . $project->created_at->format('d/m/Y') . '</p>
            <small>' . $project->created_at->format('h:i A') . '</small>';
            })
            ->rawColumns(['title', 'url', 'category', 'status',  'actions', 'created_at'])
            ->make();
    }


    public function add()
    {
        return view('admin.project.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255|unique:projects,title',
            'content' => 'required',
            'description' => 'required',
            'images' => 'required',
            'category_id' => 'required',
            'url' => 'nullable|url',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'content.required' => 'Vui lòng nhập nội dung',
            'images.required' => 'Bắt buộc phải thêm một hình làm ảnh bìa',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'description.required' => 'Vui lòng thêm nội dung',
            'url.url' => "Phải đúng định dạng"
        ]);

        $data['slug'] = Str::slug($request->title);
        $check = Project::insert($data);
        if ($check) {
            return back()->with('msgSuccess', 'Tạo mới thành công');
        }
        return back()->with('msgError', 'Tạo mới thất bại');
    }

    public function edit(Request $request, $id)
    {
        $project = Project::withTrashed()->find($id);

        if (!$project) {
            abort(404);
        }
        return view('admin.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|max:255|unique:projects,title,' . $id,
            'content' => 'required',
            'description' => 'required',
            'images' => 'required',
            'category_id' => 'required',
            'url' => 'nullable|url',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'content.required' => 'Vui lòng nhập nội dung',
            'images.required' => 'Bắt buộc phải thêm một hình làm ảnh bìa',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'description.required' => 'Vui lòng thêm nội dung',
            'url.url' => "Phải đúng định dạng"
        ]);

        $data['slug'] = Str::slug($request->title);
        $check = Project::withTrashed()->where('id', $id)->update($data);

        if ($check) {
            return back()->with('msgSuccess', 'Cập nhật thành công');
        }
        return back()->with('msgError', 'Cập nhật thất bại');
    }

    public function softDelete($id)
    {

        $check = Project::destroy($id);

        if ($check) {
            return back()->with('msgSuccess', 'Tạm dừng thành công');
        }
        return back()->with('msgError', 'Tạm dừng thất bại');
    }

    public function restore($id)
    {
        $check = Project::onlyTrashed()->where('id', $id)->restore();

        if ($check) {
            return back()->with('msgSuccess', 'Khôi phục thành công');
        }
        return back()->with('msgError', 'Khôi phục thất bại');
    }

    public function forceDelete($id)
    {

        $check = Project::onlyTrashed()->where('id', $id)->forceDelete();

        if ($check) {
            return back()->with('msgSuccess', 'Xóa thành công');
        }
        return back()->with('msgError', 'Xóa thất bại');
    }
}
