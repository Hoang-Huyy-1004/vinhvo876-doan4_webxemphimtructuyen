<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\Views; // <--- 1. THÊM DÒNG NÀY ĐỂ SỬ DỤNG MODEL VIEWS
use App\Models\LichSuView;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // public function phuongThucXemPhim($id)
    // {
    //     // xử lý logic lấy phim theo id
    //     $phim = Phim::findOrFail($id);
    //     return view('xem_phim', compact('phim'));
    // }

    public function phuongThucXemPhim($id)
    {
        // 1. Load phim kèm thể loại (Chú ý: dùng 'theloais' viết liền giống trong Model vừa sửa)
        $phim = Phim::with('theloais')->findOrFail($id);

        $viewTong = Views::firstOrCreate(
            ['phim_id' => $id], 
            ['tong_views' => 0]
        );
        $viewTong->increment('tong_views');

        // B. Tăng view ngày (Bảng 'lich_su_views' mới - dùng cho Biểu đồ)
        // Tìm xem HÔM NAY phim này đã có dòng lịch sử nào chưa
        $viewNgay = LichSuView::firstOrCreate(
            [
                'phim_id' => $id, 
                'ngay' => now()->toDateString() // Lấy ngày hiện tại YYYY-MM-DD
            ],
            ['view_ngay' => 0]
        );
        $viewNgay->increment('view_ngay');

        // 2. Lấy ID thể loại
        $theLoaiIds = $phim->theloais->pluck('id');

        // --- KIỂM TRA NHANH (DEBUG) ---
        // Nếu dòng dưới in ra mảng rỗng [] -> Phim này chưa được gán thể loại nào trong DB.
        // Nếu in ra [1, 3] -> Phim đã có thể loại, lỗi do truy vấn tìm phim khác.
        // dd($theLoaiIds->toArray()); 
        // (Bỏ comment dòng trên để test, test xong nhớ xóa đi)

        // 3. Nếu phim này không có thể loại nào, trả về danh sách rỗng luôn
        if ($theLoaiIds->isEmpty()) {
            $phimLienQuan = collect(); // Trả về bộ sưu tập rỗng
        } else {
            // 4. Tìm phim khác
            $phimLienQuan = Phim::whereHas('theloais', function ($query) use ($theLoaiIds) {
                $query->whereIn('the_loai.id', $theLoaiIds);
            })
                ->where('id', '!=', $id)
                ->where('trang_thai', 'cong_khai') // Đảm bảo phim kia cũng đang công khai
                ->inRandomOrder()
                ->take(10)
                ->get();
        }

        return view('xem_phim', compact('phim', 'phimLienQuan'));
    }

    public function index()
    {
        // --- 2. THÊM ĐOẠN NÀY: Lấy top 10 phim có tong_views cao nhất ---
        $top10 = Views::with('phim') // Load kèm thông tin phim để hiển thị ảnh, tên...
            ->orderBy('tong_views', 'desc') // Sắp xếp view giảm dần
            ->take(10) // Lấy 10 phim
            ->get();
        // ----------------------------------------------------------------

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

        // --- 3. NHỚ TRUYỀN BIẾN $top10 VÀO VIEW ---
        return view('home', compact('phimMoi', 'phimNoiBat', 'phimHot', 'phimbinhthuong', 'top10'));
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

    public function showSearchPage(Request $request)
    {
        // Bạn cũng cần lấy Top 10 ở đây để hiển thị bên trang tìm kiếm
        $top10 = Views::with('phim')
            ->orderBy('tong_views', 'desc')
            ->take(10)
            ->get();

        // Xử lý tìm kiếm (nếu người dùng đã nhập từ khóa)
        // Code tìm kiếm của bạn sẽ nằm ở đây...
        
        // CHỈ TRẢ VỀ VIEW 'tim_kiem'
        return view('tim_kiem', compact('top10'));
    }
}