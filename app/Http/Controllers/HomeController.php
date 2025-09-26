<?php

namespace App\Http\Controllers;

use App\Models\Phim;

class HomeController extends Controller
{
    public function phuongThucXemPhim($id)
    {
        // 1. Tìm phim theo ID
        // $phim = Phim::findOrFail($id); // Giả sử bạn có Model Phim

        // 2. Trả về view và truyền dữ liệu phim
        // return view('ten_view_xem_phim', compact('phim'));

        // Tạm thời, để kiểm tra xem đã hết lỗi chưa:
        return "Đang xem phim có ID: " . $id;
    }
    
    public function index()
    {
        $phimMoi = Phim::where('hien_thi', 'moi')
            ->where('trang_thai', 'cong_khai')
            ->latest()
            ->take(10)
            ->get();

        $phimNoiBat = Phim::where('hien_thi', 'noi_bat')
            ->where('trang_thai', 'cong_khai')
            ->latest()
            ->take(10)
            ->get();

        $phimHot = Phim::where('hien_thi', 'hot')
            ->where('trang_thai', 'cong_khai')
            ->latest()
            ->take(10)
            ->get();

        return view('home', compact('phimMoi', 'phimNoiBat', 'phimHot'));
    }
}
