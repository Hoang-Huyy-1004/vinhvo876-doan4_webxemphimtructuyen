<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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
            'hien_thi' => 'required|string|in:binh_thuong,noi_bat,moi,hot', //mới thêm
        ]);

        // Tạo thư mục theo loại và tên phim
        $tenThuMuc = Str::slug($request->ten_phim, '_');
        $basePath = public_path('img/ds_phim');

        // Chuyển đổi giá trị 'le' và 'bo' từ form thành 'phim_le' và 'phim_bo' cho DB
        $loaiValue = ($request->loai === 'le') ? 'phim_le' : 'phim_bo';

        // Lấy giá trị trực tiếp từ form
        $trangThaiValue = $request->trang_thai;

        // Dòng mới: Lấy giá trị trực tiếp từ form cho 'hien_thi'
        $hienThiValue = $request->hien_thi;


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
            // Dòng mới: Thêm trường 'hien_thi' vào đây
            'hien_thi' => $hienThiValue,
            'duong_dan' => null,
        ]);

        // Gán thể loại
        $phim->theloais()->attach($request->theloai);

        return redirect()->route('phim.create')->with('success', 'Thêm phim thành công!');
    }
        // Xóa phim
    public function destroy(Phim $phim)
    {
        // 1. Xóa các mối quan hệ (thể loại) trước
        $phim->theloais()->detach();

        // 2. Xóa các file (ảnh bìa, trailer, video)
        // Lấy đường dẫn thư mục cha để xóa
        $folderToDelete = null;

        if ($phim->loai === 'phim_bo' && $phim->anh_bia) {
            // Lấy phần đường dẫn thư mục: img/ds_phim/ds_phim_bo/ten_phim_slug
            $folderToDelete = dirname(public_path($phim->anh_bia));
        } elseif ($phim->loai === 'phim_le' && $phim->anh_bia) {
            // Lấy phần đường dẫn thư mục: img/ds_phim/ds_phim_le/ten_phim_slug
            $folderToDelete = dirname(public_path($phim->anh_bia));
        }

        // Xóa thư mục và tất cả nội dung bên trong nếu nó tồn tại
        if ($folderToDelete && File::exists($folderToDelete)) {
             // Kiểm tra để đảm bảo chúng ta không xóa thư mục gốc
             if (Str::contains($folderToDelete, 'ds_phim_bo') || Str::contains($folderToDelete, 'ds_phim_le')) {
                 File::deleteDirectory($folderToDelete);
             }
        }
        
        // 3. Xóa bản ghi phim
        $phim->delete();

        return redirect()->route('phim.phim_le')->with('success', 'Xóa phim thành công!');
    }

        // Form chỉnh sửa phim
    public function edit(Phim $phim)
    {
        $theloais = TheLoai::all();
        // Cần truyền phim cần sửa và danh sách thể loại sang view
        return view('admin.phim.sua_phim', compact('phim', 'theloais'));
    }

    // Cập nhật thông tin phim
    public function update(Request $request, Phim $phim)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'ten_phim' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'nam_phat_hanh' => 'nullable|integer',
            // File ảnh/video là nullable, không bắt buộc upload lại
            'anh_bia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'loai' => 'required|string|in:le,bo',
            'trailer' => 'nullable|mimes:mp4,mkv,avi,mov,flv|max:51200',
            'video' => 'nullable|mimes:mp4,mkv,avi,mov,flv|max:102400',
            'thoi_luong' => 'nullable|string|max:50',
            'trang_thai' => 'nullable|string|in:cong_khai,nhap',
            'theloai' => 'required|array',
            'hien_thi' => 'required|string|in:binh_thuong,noi_bat,moi,hot',
        ]);

        // 2. Chuẩn bị dữ liệu và xử lý file (tương tự như store, nhưng phức tạp hơn)
        
        // Chuyển đổi giá trị 'le' và 'bo'
        $loaiValue = ($request->loai === 'le') ? 'phim_le' : 'phim_bo';
        $trangThaiValue = $request->trang_thai;
        $hienThiValue = $request->hien_thi;

        // Lưu trữ đường dẫn cũ
        $anhBiaDb = $phim->anh_bia;
        $trailerDb = $phim->trailer;
        $videoDb = $phim->video;
        
        // *** Xử lý việc di chuyển/đổi tên thư mục nếu 'loai' hoặc 'ten_phim' thay đổi ***
        // Việc này khá phức tạp, tạm thời chúng ta sẽ chỉ tập trung vào cập nhật file trong thư mục hiện tại.
        // Trong trường hợp này, ta sẽ không đổi tên thư mục.

        // Lấy lại tên thư mục dựa trên thông tin hiện tại trong DB hoặc request
        $tenThuMuc = Str::slug($phim->ten_phim, '_');
        $basePath = public_path('img/ds_phim');
        
        if ($phim->loai === 'phim_bo') {
            $folder = $basePath . '/ds_phim_bo/' . $tenThuMuc;
            $dbPath = 'img/ds_phim/ds_phim_bo/' . $tenThuMuc;
        } else {
            $folder = $basePath . '/ds_phim_le/' . $tenThuMuc;
            $dbPath = 'img/ds_phim/ds_phim_le/' . $tenThuMuc;
        }
        
        // Nếu thư mục không tồn tại (chẳng may bị xóa), tạo lại
        if (!file_exists($folder)) {
            \Illuminate\Support\Facades\File::makeDirectory($folder, 0777, true, true);
        }
        

        // Xử lý upload và xóa file cũ nếu có file mới
        if ($request->hasFile('anh_bia')) {
            // Xóa file cũ nếu tồn tại
            if ($phim->anh_bia && \Illuminate\Support\Facades\File::exists(public_path($phim->anh_bia))) {
                \Illuminate\Support\Facades\File::delete(public_path($phim->anh_bia));
            }
            $fileName = time() . '_' . $request->file('anh_bia')->getClientOriginalName();
            $request->file('anh_bia')->move($folder, $fileName);
            $anhBiaDb = $dbPath . '/' . $fileName;
        }

        if ($request->hasFile('trailer')) {
            if ($phim->trailer && \Illuminate\Support\Facades\File::exists(public_path($phim->trailer))) {
                \Illuminate\Support\Facades\File::delete(public_path($phim->trailer));
            }
            $fileName = time() . '_' . $request->file('trailer')->getClientOriginalName();
            $request->file('trailer')->move($folder, $fileName);
            $trailerDb = $dbPath . '/' . $fileName;
        }

        if ($request->hasFile('video')) {
            if ($phim->video && \Illuminate\Support\Facades\File::exists(public_path($phim->video))) {
                \Illuminate\Support\Facades\File::delete(public_path($phim->video));
            }
            $fileName = time() . '_' . $request->file('video')->getClientOriginalName();
            $request->file('video')->move($folder, $fileName);
            $videoDb = $dbPath . '/' . $fileName;
        }


        // 3. Cập nhật thông tin vào DB
        $phim->update([
            'ten_phim' => $request->ten_phim,
            'mo_ta' => $request->mo_ta,
            'nam_phat_hanh' => $request->nam_phat_hanh,
            'anh_bia' => $anhBiaDb,
            // KHÔNG CẬP NHẬT 'loai' ở đây để tránh lỗi đường dẫn thư mục phức tạp
            // Nếu bạn muốn update 'loai', bạn phải xử lý đổi tên và di chuyển thư mục
            'trailer' => $trailerDb,
            'video' => $videoDb,
            'thoi_luong' => $request->thoi_luong,
            'trang_thai' => $trangThaiValue,
            'hien_thi' => $hienThiValue,
            // 'duong_dan' => null, // Giữ nguyên null hoặc cập nhật nếu cần
        ]);

        // 4. Đồng bộ thể loại (sync sẽ xóa cái cũ và thêm cái mới)
        $phim->theloais()->sync($request->theloai);

        return redirect()->route('phim.phim_le')->with('success', 'Cập nhật phim thành công!');
    }
}
