<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Lấy danh sách thông báo mới nhất (ví dụ lấy 10 cái)
    $notifications = Notification::latest()->take(10)->get();

    // Chia sẻ biến $notifications cho tất cả view
    View::share('notifications', $notifications);
    }
}
