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
        
        // Trỏ đúng vào file: resources/views/admin/phim/views/index.blade.php
        // (Nếu bạn chưa có file này thì hàm này sẽ lỗi, nhưng hiện tại chưa quan trọng)
        return view('admin.phim.views.index', compact('views'));
    }

    public function edit($id)
    {
        // Lấy dữ liệu từ bảng 'views'
        $view = Views::with('phim')->findOrFail($id);
        
        // Trỏ đúng vào file: resources/views/admin/phim/views/edit.blade.php
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
        
        // Trỏ đúng vào file: resources/views/admin/phim/views/edit_tap.blade.php
        return view('admin.phim.views.edit_tap', compact('tap'));
    }

    public function updateTap(Request $request, $id)
    {
        
        $request->validate([
            'view_tap' => 'required|integer|min:0'
        ]);
        
        $tap = TapPhim::findOrFail($id);
        
        // Cập nhật cột view_tap
        $tap->update([
            'view_tap' => $request->view_tap
        ]);

        // Quay lại trang chi tiết bộ phim sau khi lưu
        return redirect()->route('phim.show', $tap->phim_id)
                         ->with('success', 'Đã cập nhật view tập phim!');
    }
}