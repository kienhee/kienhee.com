<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $result = Category::query();

        if ($request->has('keywords') && $request->keywords != null) {
            $result->where('name', 'like', '%' . $request->keywords . '%');
        }
        if ($request->has('type') && $request->type != null) {
            $result->where('type',  $request->type);
        }

        if ($request->has('sort') && $request->sort != null) {
            $result->orderBy('created_at', $request->sort);
        } else {
            $result->orderBy('created_at', 'desc');
        }
        if ($request->has('status') && $request->status != null && $request->status == 'active') {
            $result->where('deleted_at', "=", null);
        } elseif ($request->has('status') && $request->status != null && $request->status == 'inactive') {
            $result->onlyTrashed();
        } else {
            $result->withTrashed();
        }
        $categories = $result->paginate(10);
        return view('admin.category.index', compact('categories'));
    }
    public function add()
    {
        return view('admin.category.add');
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            "cover" => "nullable",
            'name' => 'required|max:50|unique:categories,name',
            'category_id' => 'required|numeric',
            'description' => 'max:255',
            'type' => "required|numeric",
        ], [
            "name.required" => "Vui lòng nhập trường này",
            "name.unique" => "Tên này đã tồn tại!",
            "name.max" => "Tối đa :max kí tự",
            "description.max" => "Tối đa :max kí tự",
            "category_id.required" => "Vui lòng lựa chọn",
            "category_id.numeric" => "Giá trị phải là số",
            "type.required" => "Vui lòng lựa chọn",
            "type.numeric" => "Giá trị phải là số",
        ]);
        $validate['slug'] = Str::slug($request->name);
        $check = Category::insert($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Thêm thành công');
        }
        return back()->with('msgError', 'Thêm thất bại!');
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            "cover" => "nullable",
            'name' => 'required|max:50|unique:categories,name,' . $id,
            'category_id' => 'required|numeric',
            'description' => 'nullable',
            'type' => "required|numeric",
        ], [
            "name.required" => "Vui lòng nhập trường này",
            "name.unique" => "Tên này đã tồn tại!",
            "name.max" => "Tối đa :max kí tự",
            "category_id.required" => "Vui lòng lựa chọn",
            "category_id.numeric" => "Giá trị phải là số",
            "type.required" => "Vui lòng lựa chọn",
            "type.numeric" => "Giá trị phải là số",
        ]);
        $validate['slug'] = Str::slug($request->name);
        $check = Category::where('id', $id)->update($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Cập nhật thành công');
        }
        return back()->with('msgError', 'Cập nhật thất bại!');
    }
    public function softDelete($id)
    {
        $check =
            Category::destroy($id);
        if ($check) {
            return back()->with('msgSuccess', 'Đổi trạng thái thành công');
        }
        return back()->with('msgError', 'Đổi trạng thái thất bại!');
    }
    public function restore($id)
    {
        $check = Category::onlyTrashed()->where('id', $id)->restore();
        if ($check) {
            return back()->with('msgSuccess', 'Khôi phục dùng thành công');
        }
        return back()->with('msgError', 'Khôi phục dùng thất bại!');
    }
    public function forceDelete($id)
    {
        $CheckProductExists = Post::where('category_id', $id)->get();
        if ($CheckProductExists->count() > 0) {
            return back()->with('msgError', 'Có ' . $CheckProductExists->count() . ' sản phẩm trong danh mục này , không thể xóa');
        }
        $check = Category::onlyTrashed()->where('id', $id)->forceDelete();
        if ($check) {
            return back()->with('msgSuccess', 'Xóa thành công');
        }
        return back()->with('msgError', 'Xóa thất bại!');
    }
}
