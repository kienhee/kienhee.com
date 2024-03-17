<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CharacteristicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\DropzoneController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\SavePostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ClientController;
use App\Models\Characteristic;
use App\Models\District;
use App\Models\Group;
use App\Models\Post;
use App\Models\Project;
use App\Models\Province;
use App\Models\Region;
use App\Models\Tag;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->name('client.')->group(function () {
    Route::get("/", [ClientController::class, 'home'])->name('index');
    Route::get("about-me", [ClientController::class, 'author'])->name('author');
    Route::get("posts/{slug}", [ClientController::class, 'blog'])->name('blog');
    Route::post("posts/{id}", [ClientController::class, 'commentPost'])->name('commentPost');
    Route::get("work/{slug}", [ClientController::class, 'work'])->name('work');
});
Route::prefix('/vung-oi-mo-cua-ra')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/add', [categoryController::class, 'add'])->name('add');
        Route::post('/add', [categoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [categoryController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [categoryController::class, 'update'])->name('update');
        Route::delete('/soft-delete/{id}', [categoryController::class, 'softDelete'])->name('soft-delete');
        Route::delete('/force-delete/{id}', [categoryController::class, 'forceDelete'])->name('force-delete');
        Route::delete('/restore/{id}', [categoryController::class, 'restore'])->name('restore');
    });
    Route::prefix('users')->name('users.')->middleware('can:users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index')->can('view', User::class);
        Route::get('/list', [UserController::class, 'list'])->name('list')->can('view', User::class);
        Route::get('/add', [UserController::class, 'add'])->name('add')->can('create', User::class);
        Route::post('/store', [UserController::class, 'store'])->name('store')->can('create', User::class);
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit')->can('update', User::class);
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update')->can('update', User::class);
        Route::post('/soft-delete/{id}', [UserController::class, 'softDelete'])->name('soft-delete')->can('delete', User::class);
        Route::post('/restore/{id}', [UserController::class, 'restore'])->name('restore')->can('delete', User::class);
        Route::post('/force-delete/{id}', [UserController::class, 'forceDelete'])->name('force-delete')->can('delete', User::class);
    });
    Route::prefix('posts')->name('posts.')->middleware('can:posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index')->can('view', Post::class);
        Route::get('/list', [PostController::class, 'list'])->name('list')->can('view', Post::class);
        Route::get('/add', [PostController::class, 'add'])->name('add')->can('create', Post::class);
        Route::post('/store', [PostController::class, 'store'])->name('store')->can('create', Post::class);
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit')->can('update', Post::class);
        Route::put('/update/{id}', [PostController::class, 'update'])->name('update')->can('update', Post::class);
        Route::post('/soft-delete/{id}', [PostController::class, 'softDelete'])->name('soft-delete')->can('delete', Post::class);
        Route::post('/restore/{id}', [PostController::class, 'restore'])->name('restore')->can('delete', Post::class);
        Route::post('/force-delete/{id}', [PostController::class, 'forceDelete'])->name('force-delete')->can('delete', Post::class);
    });
    Route::prefix('projects')->name('projects.')->middleware('can:projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index')->can('view', Project::class);
        Route::get('/list', [ProjectController::class, 'list'])->name('list')->can('view', Project::class);
        Route::get('/add', [ProjectController::class, 'add'])->name('add')->can('create', Project::class);
        Route::post('/store', [ProjectController::class, 'store'])->name('store')->can('create', Project::class);
        Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit')->can('update', Project::class);
        Route::put('/update/{id}', [ProjectController::class, 'update'])->name('update')->can('update', Project::class);
        Route::post('/soft-delete/{id}', [ProjectController::class, 'softDelete'])->name('soft-delete')->can('delete', Project::class);
        Route::post('/restore/{id}', [ProjectController::class, 'restore'])->name('restore')->can('delete', Project::class);
        Route::post('/force-delete/{id}', [ProjectController::class, 'forceDelete'])->name('force-delete')->can('delete', Project::class);
    });
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
        Route::put('/change-password/{email}', [ProfileController::class, 'handleChangePassword'])->name('handle-change-password');
        Route::get('/login-history', [ProfileController::class, 'loginHistory'])->name('login-history');
    });
    Route::prefix('tags')->name('tags.')->middleware('can:tags')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('index')->can('view', Tag::class);
        Route::get('/list', [TagController::class, 'list'])->name('list')->can('view', Tag::class);
        Route::get('/add', [TagController::class, 'add'])->name('add')->can('create', Tag::class);
        Route::post('/store', [TagController::class, 'store'])->name('store')->can('create', Tag::class);
        Route::get('/edit/{id}', [TagController::class, 'edit'])->name('edit')->can('update', Tag::class);
        Route::put('/update/{id}', [TagController::class, 'update'])->name('update')->can('update', Tag::class);
        Route::post('/soft-delete/{id}', [TagController::class, 'softDelete'])->name('soft-delete')->can('delete', Tag::class);
        Route::post('/restore/{id}', [TagController::class, 'restore'])->name('restore')->can('delete', Tag::class);
        Route::post('/force-delete/{id}', [TagController::class, 'forceDelete'])->name('force-delete')->can('delete', Tag::class);
    });
    Route::prefix('permission')->name('permission.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index')->can('view', Group::class);
        Route::get('/add-role', [PermissionController::class, 'addRole'])->name('add-role')->can('create', Group::class);
        Route::post('/store-role', [PermissionController::class, 'storeRole'])->name('store-role')->can('create', Group::class);
        Route::get('/edit-role/{group}', [PermissionController::class, 'editRole'])->name('edit-role')->can('update', Group::class);
        Route::put('/update-role/{id}', [PermissionController::class, 'updateRole'])->name('update-role')->can('update', Group::class);
        Route::delete('/delete-role/{id}', [PermissionController::class, 'deleteRole'])->name('delete-role')->can('delete', Group::class);

        Route::get('/list-permission', [PermissionController::class, 'listPermission'])->name('list-permission');
        Route::post('/add-permission', [PermissionController::class, 'addPermission'])->name('add-permission');
        Route::get('/edit-permission/{module}', [PermissionController::class, 'editPermission'])->name('edit-permission');
        Route::put('/update-permission/{id}', [PermissionController::class, 'updatePermission'])->name('update-permission');
        Route::post('/delete-permission/{id}', [PermissionController::class, 'deletePermission'])->name('delete-permission');
    });
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::put('/', [SettingController::class, 'update'])->name('update');
    });
    Route::get('/library', function () {
        return view('admin.library.index');
    })->name('library');
});
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'handleRegister'])->name('handleRegister');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'handleLogin'])->name('handleLogin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/forgot-password', [AuthController::class, 'ForgotPassword'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'SendMailForgotPassword'])->name('SendMailForgotPassword');
    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [AuthController::class, 'PostResetPassword'])->name('PostResetPassword');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
