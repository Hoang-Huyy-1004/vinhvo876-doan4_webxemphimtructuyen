<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Views;
use App\Models\TapPhim;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    // ==============================================================
    // PHẦN 1: DÙNG CHO PHIM LẺ (Bảng views)
    // ==============================================================

    public function index()
    {
        // Hiển thị danh sách view (nếu cần)
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
        
        // Cập nhật số view mới
        $view->update([
            'tong_views' => $request->tong_views
        ]);
        
        // Quay lại trang chi tiết phim lẻ sau khi lưu
        return redirect()->route('phim.show', $view->phim_id)
                         ->with('success', 'Cập nhật view phim lẻ thành công!');
    }

    // ==============================================================
    // PHẦN 2: DÙNG CHO PHIM BỘ (Bảng tap_phim)
    // ==============================================================

    public function editTap($id)
    {
        // Lấy dữ liệu từ bảng 'tap_phim'
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
        
        // BƯỚC 1: Cập nhật view cho tập phim này (view_tap vẫn là view riêng)
        $tap->update([
            'view_tap' => $request->view_tap
        ]);

        // BƯỚC 2: Tính tổng view của TẤT CẢ các tập thuộc phim này
        // (Lấy những dòng có cùng phim_id và cộng cột view_tap lại)
        $totalViews = TapPhim::where('phim_id', $tap->phim_id)->sum('view_tap');

        // BƯỚC 3: Cập nhật (hoặc tạo mới) vào bảng 'views' cột 'tong_views'
        // updateOrCreate: Tìm record theo phim_id, nếu thấy thì update, chưa thấy thì create
        Views::updateOrCreate(
            ['phim_id' => $tap->phim_id], // Điều kiện tìm kiếm
            ['tong_views' => $totalViews] // Dữ liệu cần cập nhật
        );

        // Quay lại trang chi tiết bộ phim sau khi lưu
        return redirect()->route('phim.show', $tap->phim_id)
                         ->with('success', 'Đã cập nhật view tập và đồng bộ tổng view phim!');
    }
}