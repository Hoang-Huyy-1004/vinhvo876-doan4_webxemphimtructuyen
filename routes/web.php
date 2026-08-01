<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
// use App\Http\Controllers\VideoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\TapPhimController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ViewController;
//lịch sử xem phim test
use App\Http\Controllers\RecommendationController;


Route::get('/', function () {
    return view('home');  // tự động tìm home.blade.php trong resources/views
})->name('home');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

// Route::get('/search', [VideoController::class, 'search'])->name('search');



Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
});

// Route::get('/', [HomeController::class, 'index'])->name('home');

// user- đăng ký, đăng nhập, thông tin tài khoản
Route::get('/dang-ky', [AuthController::class, 'showRegister'])->name('dangky.form');
Route::post('/dang-ky', [AuthController::class, 'register'])->name('dangky');

Route::get('/dang-nhap', [AuthController::class, 'showLogin'])->name('dangnhap.form');
Route::post('/dang-nhap', [AuthController::class, 'login'])->name('dangnhap');

Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('dangxuat');

// Thông tin tài khoản (chỉ khi đã đăng nhập)
Route::get('/taikhoan', [AuthController::class, 'profile'])
    ->name('thongtintaikhoan')
    ->middleware('auth');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tat-ca-phim-le', [HomeController::class, 'showPhimLe'])->name('show.phimle');
Route::get('/tat-ca-phim-bo', [HomeController::class, 'showPhimBo'])->name('show.phimbo');
Route::get('/the-loai/tinh-cam', [HomeController::class, 'showPhimTinhCam'])->name('show.tinhcam');
Route::get('/the-loai/hoat-hinh', [HomeController::class, 'showPhimHoatHinh'])->name('show.hoathinh');
Route::get('/tim-kiem', [HomeController::class, 'showSearchPage'])->name('page.timkiem');
Route::get('/ajax-search', [HomeController::class, 'ajaxSearch'])->name('ajax.search');

// routes/web.php

// Định nghĩa route cho việc xem một bộ phim
Route::get('/xem-phim/{phim}', [HomeController::class, 'phuongThucXemPhim'])
    ->name('xemphim');
// Đặt tên route là 'xemphim'












//admin
Route::prefix('admin')->group(function () {
    Route::get('/danhmuc', [DanhMucController::class, 'index'])->name('danhmuc.index');
    Route::post('/danhmuc', [DanhMucController::class, 'store'])->name('danhmuc.store');
    Route::put('/danhmuc/{id}', [DanhMucController::class, 'update'])->name('danhmuc.update');
    Route::delete('/danhmuc/{id}', [DanhMucController::class, 'destroy'])->name('danhmuc.destroy');
    Route::get('/ds_taikhoan', [AuthController::class, 'listUsers']) // Route hiển thị danh sách tài khoản
        ->name('admin.taikhoan.ds_taikhoan');
    // ROUTE CHUYỂN ĐỔI TRẠNG THÁI TÀI KHOẢN (PUT)
    Route::put('/taikhoan/toggle-status/{user_id}', [AuthController::class, 'toggleStatus'])
        ->name('admin.taikhoan.toggle_status');
});

// Nhóm route cho phim
Route::prefix('admin/phim')->name('phim.')->group(function () {
    // Danh sách tất cả phim
    Route::get('/', [PhimController::class, 'index'])->name('index');

    // Danh sách phim lẻ
    Route::get('/phim-le', [PhimController::class, 'phimLe'])->name('phim_le');

    // Danh sách phim bộ
    Route::get('/phim-bo', [PhimController::class, 'phimBo'])->name('phim_bo');

    // Form thêm phim
    Route::get('/them-phim', [PhimController::class, 'create'])->name('create');

    // Lưu phim mới
    Route::post('/them', [PhimController::class, 'store'])->name('store');


    // Thêm route xóa phim
    Route::delete('/{phim}', [PhimController::class, 'destroy'])->name('destroy');

    // Form chỉnh sửa phim
    Route::get('/{phim}/chinh-sua', [PhimController::class, 'edit'])->name('edit');

    // Lưu phim đã chỉnh sửa (Dùng phương thức PUT/PATCH)
    Route::put('/{phim}', [PhimController::class, 'update'])->name('update');

    //thông tin chi tiết phim
    Route::get('/{phim}', [PhimController::class, 'show'])->name('show');


    // Nhóm route cho Tập Phim
    Route::prefix('{phim}/tapphim')->name('tapphim.')->group(function () {
        Route::get('/{tapPhim}/chinh-sua', [TapPhimController::class, 'edit'])->name('edit');
        Route::put('/{tapPhim}', [TapPhimController::class, 'update'])->name('update');
    });
});



Route::get('/xem-phim/{id}', [HomeController::class, 'phuongThucXemPhim']);



// Route cho admin (resource)
Route::resource('phim', PhimController::class);

// Route cho người dùng xem phim
Route::get('/xem-phim/{id}', [PhimController::class, 'showClient'])->name('xemphim');

// Google Routes
Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::view('/user/dangnhap', 'user.dangnhap');
Route::view('/user/dangky', 'user.dangky');
Route::view('/user/taikhoan', 'user.taikhoan');

// Admin ViewController routes
Route::prefix('admin')->group(function () {

    // 1. Xem danh sách view (nếu cần)
    Route::get('/views', [ViewController::class, 'index'])->name('views.index');

    // 2. Route cho Phim Lẻ (Bảng views)
    Route::get('/views/{id}/edit', [ViewController::class, 'edit'])->name('views.edit');
    Route::put('/views/{id}', [ViewController::class, 'update'])->name('views.update');

    // 3. Route cho Phim Bộ (Bảng tap_phim)
    Route::get('/views/tap/{id}/edit', [ViewController::class, 'editTap'])->name('views.tap.edit');
    Route::put('/views/tap/{id}', [ViewController::class, 'updateTap'])->name('views.tap.update');
});

// Lịch sử xem phim test

// Route::get('/recommend', [RecommendController::class, 'index']);

// Route::post('/recommend', [RecommendController::class, 'recommend']);
Route::get('/recommend/{userId}', [RecommendationController::class, 'recommend'])->name('recommend');
