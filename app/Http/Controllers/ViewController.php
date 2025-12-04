<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Views;
use App\Models\TapPhim;
use App\Models\LichSuView; // <--- Thêm Model này
use Illuminate\Http\Request;

class ViewController extends Controller
{
    // ==============================================================
    // PHẦN 1: DÙNG CHO PHIM LẺ (Bảng views)
    // ==============================================================

    public function index()
    {
        // Hiển thị danh sách view
        $views = Views::with('phim')->orderBy('tong_views', 'desc')->paginate(10);
        
        return view('admin.phim.views.index', compact('views'));
    }

    public function edit($id)
    {
        // Lấy dữ liệu từ bảng 'views'
        $view = Views::with('phim')->findOrFail($id);
        
        return view('admin.phim.views.edit', compact('view'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tong_views' => 'required|integer|min:0'
        ]);
        
        $view = Views::findOrFail($id);
        
        // 1. Cập nhật số view tổng mới vào bảng views
        $view->update([
            'tong_views' => $request->tong_views
        ]);

        // 2. [MỚI] Đồng bộ sang bảng lịch sử (lich_su_views) ngay lập tức
        // Logic: Tìm dòng lịch sử của phim này trong HÔM NAY. Nếu có thì update, chưa có thì tạo mới.
        LichSuView::updateOrCreate(
            [
                'phim_id' => $view->phim_id,
                'ngay' => now()->toDateString() // Ngày hiện tại (YYYY-MM-DD)
            ],
            [
                'view_ngay' => $request->tong_views // Lưu tổng view mới nhất vào lịch sử
            ]
        );
        
        return redirect()->route('phim.show', $view->phim_id)
                         ->with('success', 'Cập nhật view phim lẻ và đồng bộ lịch sử thành công!');
    }

    // ==============================================================
    // PHẦN 2: DÙNG CHO PHIM BỘ (Bảng tap_phim)
    // ==============================================================

    public function editTap($id)
    {
        $tap = TapPhim::with('phim')->findOrFail($id);
        return view('admin.phim.views.edit_tap', compact('tap'));
    }

    public function updateTap(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'view_tap' => 'required|integer|min:0'
        ]);
        
        // Tìm tập phim hiện tại
        $tap = TapPhim::findOrFail($id);
        
        // BƯỚC 1: Cập nhật view cho tập phim này
        $tap->update([
            'view_tap' => $request->view_tap
        ]);

        // BƯỚC 2: Tính tổng view của TẤT CẢ các tập thuộc phim này
        $totalViews = TapPhim::where('phim_id', $tap->phim_id)->sum('view_tap');

        // BƯỚC 3: Cập nhật vào bảng 'views' tổng
        Views::updateOrCreate(
            ['phim_id' => $tap->phim_id],
            ['tong_views' => $totalViews]
        );

        // BƯỚC 4: [MỚI] Đồng bộ sang bảng lịch sử (lich_su_views)
        LichSuView::updateOrCreate(
            [
                'phim_id' => $tap->phim_id,
                'ngay' => now()->toDateString() // Ngày hiện tại
            ],
            [
                'view_ngay' => $totalViews // Đồng bộ số tổng mới nhất
            ]
        );

        return redirect()->route('phim.show', $tap->phim_id)
                         ->with('success', 'Đã cập nhật view tập và đồng bộ lịch sử hiển thị!');
    }
}