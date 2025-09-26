<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhimController extends Controller
{
    // Danh sách tất cả phim
    public function index()
    {
        $phims = Phim::with('theloais')->get();
        return view('admin.phim.index', compact('phims'));
    }

    // Danh sách phim lẻ
    public function phimLe()
    {
        $phims = Phim::with('theloais')->where('loai', 'phim_le')->get();
        return view('admin.phim.phim_le', compact('phims'));
    }

    // Danh sách phim bộ
    public function phimBo()
    {
        $phims = Phim::with('theloais')->where('loai', 'phim_bo')->get();
        return view('admin.phim.phim_bo', compact('phims'));
    }

    // Form thêm mới
    public function create()
    {
        $theloais = TheLoai::all();
        return view('admin.phim.them_phim', compact('theloais'));
    }

    // Lưu phim mới
    public function store(Request $request)
    {
        $request->validate([
            'ten_phim' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'nam_phat_hanh' => 'nullable|integer',
            'anh_bia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'loai' => 'required|string|in:le,bo',
            'trailer' => 'nullable|mimes:mp4,mkv,avi,mov,flv|max:51200',
            'video' => 'nullable|mimes:mp4,mkv,avi,mov,flv|max:102400',
            'thoi_luong' => 'nullable|string|max:50',
            'trang_thai' => 'nullable|string|in:cong_khai,nhap',
            'theloai' => 'required|array',
        ]);

        // Tạo thư mục theo loại và tên phim
        $tenThuMuc = Str::slug($request->ten_phim, '_');
        $basePath = public_path('img/ds_phim');

        // Chuyển đổi giá trị 'le' và 'bo' từ form thành 'phim_le' và 'phim_bo' cho DB
        $loaiValue = ($request->loai === 'le') ? 'phim_le' : 'phim_bo';
        
        // Lấy giá trị trực tiếp từ form
        $trangThaiValue = $request->trang_thai;


        if ($request->loai === 'bo') {
            $folder = $basePath . '/ds_phim_bo/' . $tenThuMuc;
            $dbPath = 'img/ds_phim/ds_phim_bo/' . $tenThuMuc;
        } else {
            $folder = $basePath . '/ds_phim_le/' . $tenThuMuc;
            $dbPath = 'img/ds_phim/ds_phim_le/' . $tenThuMuc;
        }

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Upload file
        $anhBiaDb = null;
        $trailerDb = null;
        $videoDb = null;

        if ($request->hasFile('anh_bia')) {
            $fileName = time() . '_' . $request->file('anh_bia')->getClientOriginalName();
            $request->file('anh_bia')->move($folder, $fileName);
            $anhBiaDb = $dbPath . '/' . $fileName;
        }

        if ($request->hasFile('trailer')) {
            $fileName = time() . '_' . $request->file('trailer')->getClientOriginalName();
            $request->file('trailer')->move($folder, $fileName);
            $trailerDb = $dbPath . '/' . $fileName;
        }

        if ($request->hasFile('video')) {
            $fileName = time() . '_' . $request->file('video')->getClientOriginalName();
            $request->file('video')->move($folder, $fileName);
            $videoDb = $dbPath . '/' . $fileName;
        }

        // Lưu phim
        $phim = Phim::create([
            'ten_phim' => $request->ten_phim,
            'mo_ta' => $request->mo_ta,
            'nam_phat_hanh' => $request->nam_phat_hanh,
            'anh_bia' => $anhBiaDb,
            'loai' => $loaiValue,
            'trailer' => $trailerDb,
            'video' => $videoDb,
            'thoi_luong' => $request->thoi_luong,
            'trang_thai' => $trangThaiValue,
            // Thêm trường 'duong_dan' với giá trị mặc định là null
            'duong_dan' => null,
        ]);

        // Gán thể loại
        $phim->theloais()->attach($request->theloai);

        return redirect()->route('phim.create')->with('success', 'Thêm phim thành công!');
    }
}
