<?php

use App\Models\Category;
use App\Models\Group;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

function groups()
{
  $userGroupId = Auth::user()->group_id;
  $groups = Group::query();
  if ($userGroupId == 2) {
    // Miền
    $groups->whereNotIn('id', range(1, 2));
  } elseif ($userGroupId == 3) {
    // tỉnh
    $groups->whereNotIn('id', range(1, 3));
  } elseif ($userGroupId == 4) {
    // huyện
    $groups->whereNotIn('id', range(1, 4));
  } elseif ($userGroupId == 5) {
    // trưởng phòng
    $groups->whereNotIn('id', range(1, 5));
  }

  return $groups->get();
}

function tags()
{
  $list = [];
  foreach (Tag::all() as $value) {
    $list[] = $value->name;
  }
  return  json_encode($list);
}
function getThumb($originalPath)
{
  // Tách đường dẫn thành thư mục và tên file
  $pathInfo = pathinfo($originalPath);

  // Tạo đường dẫn mới với thư mục 'thumbs'
  $newPath = $pathInfo['dirname'] . '/thumbs/' . $pathInfo['basename'];

  return $newPath;
}
function isRole($dataArr, $module, $role = 'view')
{
  if (!empty($dataArr)) {
    $roleArr = $dataArr[$module] ?? [];
    if (!empty($roleArr) && in_array($role, $roleArr)) {
      return true;
    }
  }
  return false;
}
function menuTreeCategory($menu, $parentId = 0)
{
  if ($menu->count() > 0) {
    foreach ($menu as $key => $category) {
      if ($category['category_id'] == $parentId) {
        echo '<li><a class="d-flex justify-content-between" href ="' . route('dashboard.categories.edit', $category['id']) . '" title="Click xem thêm"> <span>' . $category['name'] . '</span> </a>';
        echo '<ul >';
        echo menuTreeCategory($menu, $category['id']);
        echo '</ul>';
        echo '</li>';
        echo '</li>';
      }
    }
  }
}
function getAllCategories()
{
  return Category::orderBy('created_at', 'desc')->get();
}
function getAllCategoriesPost()
{
  return Category::orderBy('created_at', 'desc')->where('type', 1)->get();
}
function getAllCategoriesProject()
{
  return Category::orderBy('created_at', 'desc')->where('type', 2)->get();
}
function categoriesParent()
{
  return Category::where('category_id', 0)->orderBy('created_at', 'desc')->get();
}
function author()
{
  return Setting::where('id', 1)->first();
}
function getAllTags()
{
  return Tag::all();
}
function estimateReadingTime($text, $wpm = 200)
{
  $totalWords = str_word_count(strip_tags($text));
  $minutes = floor($totalWords / $wpm);
  return $minutes;
}
function createSlug($string)
{
  // Convert the string to lowercase
  $string = strtolower($string);

  // Remove special characters
  $string = preg_replace('/[^a-z0-9\-]/', '', $string);

  // Replace spaces with hyphens
  $string = str_replace(' ', '-', $string);

  // Remove consecutive hyphens
  $string = preg_replace('/-+/', '-', $string);

  // Trim any leading or trailing hyphens
  $string = trim($string, '-');

  return $string;
}
