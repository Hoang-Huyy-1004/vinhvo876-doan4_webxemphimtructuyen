<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\HomeController;



Route::get('/', function () {
    return view('home');  // tự động tìm home.blade.php trong resources/views
});

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
