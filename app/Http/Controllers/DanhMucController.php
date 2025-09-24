<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class DanhMucController extends Controller
{
    // Hiển thị danh sách + form thêm mới
    public function index()
    {
        $danhmucs = TheLoai::all();
        return view('admin.danhmuc.index', compact('danhmucs'));
    }

    // Thêm mới
    public function store(Request $request)
    {
        $request->validate([
            'ten_the_loai' => 'required|string|max:255|unique:the_loai,ten_the_loai',
        ]);

        TheLoai::create([
            'ten_the_loai' => $request->ten_the_loai,
        ]);

        return redirect()->route('danhmuc.index')->with('success', 'Thêm danh mục thành công!');
    }

    // Cập nhật
    public function update(Request $request, $id)
    {
        $danhmuc = TheLoai::findOrFail($id);

        $request->validate([
            'ten_the_loai' => 'required|string|max:255|unique:the_loai,ten_the_loai,' . $danhmuc->id . ',id',
        ]);

        $danhmuc->update([
            'ten_the_loai' => $request->ten_the_loai,
        ]);

        return redirect()->route('danhmuc.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    // Xóa
    public function destroy($id)
    {
        $danhmuc = TheLoai::findOrFail($id);
        $danhmuc->delete();

        return redirect()->route('danhmuc.index')->with('success', 'Xóa danh mục thành công!');
    }
}
