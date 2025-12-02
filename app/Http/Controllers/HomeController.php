<?php

namespace App\Http\Controllers;

use App\Models\Phim;

class HomeController extends Controller
{

    public function phuongThucXemPhim($id)
    {
        // xử lý logic lấy phim theo id
        $phim = Phim::findOrFail($id);
        return view('xem_phim', compact('phim'));
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

        $phimbinhthuong = Phim::where('hien_thi', 'binh_thuong')
            ->where('trang_thai', 'cong_khai')
            ->latest()
            ->take(10)
            ->get();

        return view('home', compact('phimMoi', 'phimNoiBat', 'phimHot', 'phimbinhthuong'));
    }

    public function showPhimLe()
    {
        // 1. Lấy tất cả phim có loại là 'phim_le' và trạng thái 'cong_khai'
        // 2. Sắp xếp mới nhất lên đầu
        // 3. Dùng paginate(12) để phân trang (mỗi trang 12 phim), thay vì get() lấy hết sẽ nặng máy
        $danhSachPhimLe = Phim::where('loai', 'phim_le')
            ->where('trang_thai', 'cong_khai')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Trả về view và truyền biến $danhSachPhimLe sang
        return view('header_phimle', compact('danhSachPhimLe'));
    }

    public function showPhimBo()
    {
        // Lấy phim có loại là 'phim_bo', sắp xếp mới nhất, phân trang 12 phim/trang
        $danhSachPhimBo = Phim::where('loai', 'phim_bo')
            ->where('trang_thai', 'cong_khai')
            ->orderBy('updated_at', 'desc') // Phim bộ thường sắp xếp theo ngày cập nhật tập mới
            ->paginate(12);

        return view('header_phimbo', compact('danhSachPhimBo'));
    }

    public function showPhimTinhCam()
    {
        // Tìm các phim có thể loại chứa chữ "Tình cảm"
        $danhSachPhim = Phim::whereHas('theLoais', function ($query) {
            $query->where('ten_the_loai', 'LIKE', '%tình cảm%');
        })
            ->where('trang_thai', 'cong_khai')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('header_phimtinhcam', compact('danhSachPhim'));
    }

    public function showPhimHoatHinh()
    {
        // Tìm các phim thuộc thể loại Hoạt hình
        $danhSachPhim = Phim::whereHas('theLoais', function ($query) {
            $query->where('ten_the_loai', 'LIKE', '%hoạt hình%');
        })
            ->where('trang_thai', 'cong_khai')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('header_phimhoathinh', compact('danhSachPhim'));
    }
}
