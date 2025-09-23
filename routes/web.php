<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('home');  // tự động tìm home.blade.php trong resources/views
})->name('home');

Route::get('/admin', function () {
    return view('admin.dashboard');
});
Route::get('/search', [VideoController::class, 'search'])->name('search');


Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
});

Route::get('/', [HomeController::class, 'index']);

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
