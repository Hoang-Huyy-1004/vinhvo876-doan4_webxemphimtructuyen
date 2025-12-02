<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\User;     // Model User mặc định của Laravel
use App\Models\LuotXem;  // Bạn cần tạo Model này nếu chưa có
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

        // 3. Đếm lượt xem TRONG HÔM NAY (dựa vào cột 'xem_luc' trong bảng luot_xem)
        // Nếu chưa có model LuotXem, bạn có thể dùng DB::table('luot_xem')->...
        // $luotXemHomNay = LuotXem::whereDate('xem_luc', Carbon::today())->count();

        // 4. Đếm tổng số bình luận
        // $tongBinhLuan = BinhLuan::count();

        // Truyền hết dữ liệu sang View
        return view('admin.dashboard', compact('tongPhim', 'tongUser' ));
    }
}