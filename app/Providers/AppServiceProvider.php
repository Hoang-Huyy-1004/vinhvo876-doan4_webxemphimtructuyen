<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL; // Thêm import này để quản lý cấu hình URL

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
        // Ép buộc Laravel sinh link bằng giao thức HTTPS khi chạy dưới môi trường production
        // Điều này giúp giải quyết triệt để lỗi Mixed Content (trình duyệt chặn ảnh HTTP tải trên website HTTPS)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Lấy danh sách thông báo mới nhất (ví dụ lấy 10 cái)
        $notifications = Notification::latest()->take(10)->get();

        // Chia sẻ biến $notifications cho tất cả view
        View::share('notifications', $notifications);
    }
}

