<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\User;     // Model User mặc định của Laravel
use App\Models\Views;   // Model Views (Phim lẻ)
use App\Models\TapPhim; // Model TapPhim (Phim bộ)
use App\Models\BinhLuan; // Bạn cần tạo Model này nếu chưa có
use Carbon\Carbon;       // Để xử lý ngày tháng (cho lượt xem hôm nay)

class AdminController extends Controller
{
    public function index()
    {
        // 1. Đếm tổng số phim
        $tongPhim = Phim::count();

        // 2. Đếm tổng số người dùng (User)
        $tongUser = User::count();

        // 3. TÍNH TỔNG LƯỢT XEM (Phim Lẻ + Phim Bộ)
        // Tổng view phim lẻ (bảng views, cột tong_views)
        $viewPhimLe = Views::sum('tong_views');
        
        // Tổng view phim bộ (bảng tap_phim, cột view)
        // $viewPhimBo = TapPhim::sum('view_tap');

        // Tổng cộng
        $tongLuotXem = $viewPhimLe ;

        // 4. Đếm tổng số bình luận
        // $tongBinhLuan = BinhLuan::count();

        // Truyền hết dữ liệu sang View
        return view('admin.dashboard', compact('tongPhim', 'tongUser', 'tongLuotXem' ));
    }
}