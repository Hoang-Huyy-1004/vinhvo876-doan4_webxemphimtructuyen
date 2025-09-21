<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');  // tự động tìm home.blade.php trong resources/views
});

Route::get('/admin', function () {
    return view('admin.dashboard');
});
Route::get('/search', [VideoController::class, 'search'])->name('search');
