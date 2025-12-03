<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\TapPhim;

class PhimController extends Controller
{
    public function showClient($id)
    {
        $phim = Phim::with(['theloais', 'taps'])->findOrFail($id);

        // Nếu view ở ngoài resources/views
        return view('xem_phim', compact('phim'));

        // Nếu view trong resources/views/user/
        // return view('user.xem_phim', compact('phim'));
    }


    // Hàm show gốc của bạn (cho admin) vẫn giữ nguyên
    public function show(Phim $phim)
    {
        $phim->load('taps');
        return view('admin.phim.thong_tin', compact('phim'));
    }

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
        // CŨ: $phims = Phim::with('theloais')->where('loai', 'phim_bo')->get();

        // MỚI: Thêm 'taps' vào with() để load trước các tập phim
        $phims = Phim::with(['theloais', 'taps'])
            ->where('loai', 'phim_bo')
            ->get();

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
            // 'anh_bia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'anh_bia' => 'nullable|image|max:2048',
            'anh_bia_url' => 'nullable|url|max:255', // ✅ thêm dòng này
            'loai' => 'required|string|in:le,bo',
            // 'trailer' => 'nullable|mimes:mp4,mkv,avi,mov,flv|max:51200',
            'trailer_type' => 'required|in:file,url',
            'trailer_file' => 'required_if:trailer_type,file|nullable|mimes:mp4,mkv,avi,mov,flv|max:51200',
            'trailer_url' => 'required_if:trailer_type,url|nullable|url|max:255',
            // 'video' => ($request->loai === 'le' ? 'required' : 'nullable') . '|file|mimes:mp4,mov,ogg,qt|max:200000', // 200MB
            'video_type' => ($request->loai === 'le' ? 'required' : 'nullable') . '|in:file,url',
            'video_file' => ($request->loai === 'le' ? 'required_if:video_type,file' : 'nullable') . '|file|mimes:mp4,mov,ogg,qt|max:200000', // 200MB
            'video_url' => ($request->loai === 'le' ? 'required_if:video_type,url' : 'nullable') . '|url|max:255',
            // Chỉ bắt buộc số tập nếu là phim bộ
            'so_tap' => ($request->loai === 'bo' ? 'required' : 'nullable') . '|integer|min:1',
            'thoi_luong' => 'nullable|string|max:50',
            'trang_thai' => 'nullable|string|in:cong_khai,nhap',
            'theloai' => 'required|array',
            'hien_thi' => 'required|string|in:binh_thuong,noi_bat,moi,hot', //mới thêm
        ]);

        // Thêm rule riêng nếu loại là 'bo'
        if ($request->loai === 'bo') {
            $request->validate([
                'so_tap' => 'required|integer|min:1',
            ]);
        }

        $slug = null;
        if ($request->filled('duong_dan')) {
            $slug = Str::afterLast(rtrim($request->duong_dan, '/'), '/');
        }

        // Tạo thư mục theo loại và tên phim
        $tenThuMuc = Str::slug($request->ten_phim, '_');
        $basePath = public_path('img/ds_phim');

        // Chuyển đổi giá trị 'le' và 'bo' từ form thành 'phim_le' và 'phim_bo' cho DB
        $loaiValue = ($request->loai === 'le') ? 'phim_le' : 'phim_bo';

        // Lấy giá trị trực tiếp từ form
        $trangThaiValue = $request->trang_thai;

        // Dòng mới: Lấy giá trị trực tiếp từ form cho 'hien_thi'
        $hienThiValue = $request->hien_thi;


        $tapPhimFolder = null; // Khởi tạo biến cho thư mục tập phim

        if ($request->loai === 'bo') {
            $folder = $basePath . '/ds_phim_bo/' . $tenThuMuc;
            $dbPath = 'img/ds_phim/ds_phim_bo/' . $tenThuMuc;
            $tapPhimFolder = $folder . '/ds_tap_phim'; // TẠO ĐƯỜNG DẪN THƯ MỤC TẬP PHIM
        } else {
            $folder = $basePath . '/ds_phim_le/' . $tenThuMuc;
            $dbPath = 'img/ds_phim/ds_phim_le/' . $tenThuMuc;
        }

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // TẠO THÊM THƯ MỤC ds_tap_phim nếu là phim bộ
        if ($request->loai === 'bo' && !file_exists($tapPhimFolder)) {
            mkdir($tapPhimFolder, 0777, true);
        }

        // Upload file
        $anhBiaDb = null;
        $trailerDb = null;
        $videoDb = null;

        if ($request->hasFile('anh_bia')) {
            $fileName = time() . '_' . $request->file('anh_bia')->getClientOriginalName();
            $request->file('anh_bia')->move($folder, $fileName);
            $anhBiaDb = $dbPath . '/' . $fileName;
        } elseif ($request->filled('anh_bia_url')) {
            // Nếu nhập URL
            $anhBiaDb = $request->anh_bia_url;
        }

        // if ($request->hasFile('trailer')) {
        //     $fileName = time() . '_' . $request->file('trailer')->getClientOriginalName();
        //     $request->file('trailer')->move($folder, $fileName);
        //     $trailerDb = $dbPath . '/' . $fileName;
        // }

        if ($request->trailer_type === 'file' && $request->hasFile('trailer_file')) {
            $fileName = time() . '_' . $request->file('trailer_file')->getClientOriginalName();
            $request->file('trailer_file')->move($folder, $fileName);
            $trailerDb = $dbPath . '/' . $fileName;
        } elseif ($request->trailer_type === 'url') {
            $trailerDb = $request->trailer_url;
        }

        // Chỉ upload video nếu là phim lẻ
        if ($request->loai === 'le') {
            if ($request->video_type === 'file' && $request->hasFile('video_file')) {
                $fileName = time() . '_' . $request->file('video_file')->getClientOriginalName();
                $request->file('video_file')->move($folder, $fileName);
                $videoDb = $dbPath . '/' . $fileName;
            } elseif ($request->video_type === 'url' && $request->filled('video_url')) {
                $videoDb = $request->video_url;
            }
        }

        // Lưu phim
        $phim = Phim::create([
            'ten_phim' => $request->ten_phim,
            'slug' => $slug,
            'mo_ta' => $request->mo_ta,
            'nam_phat_hanh' => $request->nam_phat_hanh,
            'anh_bia' => $anhBiaDb,
            'loai' => $loaiValue,
            'trailer' => $trailerDb,
            'video' => $videoDb,
            'so_tap' => ($loaiValue === 'phim_bo') ? $request->so_tap : null,  // KIỂM TRA PHIM BỘ
            'thoi_luong' => $request->thoi_luong,
            'trang_thai' => $trangThaiValue,
            // Thêm trường 'duong_dan' với giá trị mặc định là null
            // Dòng mới: Thêm trường 'hien_thi' vào đây
            'hien_thi' => $hienThiValue,
            'duong_dan' => null,
        ]);

        // Gán thể loại
        $phim->theloais()->attach($request->theloai);

        // *** CODE MỚI: TẠO TỰ ĐỘNG CÁC TẬP PHIM CHO PHIM BỘ ***
        if ($request->loai === 'bo' && $request->so_tap > 0) {
            $taps = [];
            // Lặp từ 1 đến tổng số tập đã nhập
            for ($i = 1; $i <= $request->so_tap; $i++) {
                $taps[] = [
                    'phim_id' => $phim->id,
                    'ten_phim' => $request->ten_phim, // Sử dụng tên cột 'ten_phim' trong bảng tap_phim
                    'video' => null,
                    'tap' => $i, // Số thứ tự tập (Sử dụng tên cột 'tap')
                    'trang_thai' => 'nhap', // Mặc định là nháp
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            // Chèn tất cả các tập phim vào database
            TapPhim::insert($taps);
        }

        return redirect()->route('phim.create')->with('success', 'Thêm phim thành công!');
    }
    // Xóa phim
    public function destroy(Phim $phim)
    {
        // Ghi lại loại phim trước khi xóa để biết nơi chuyển hướng
        $loaiPhim = $phim->loai;

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

        // 4. CHUYỂN HƯỚNG VỀ DANH SÁCH PHIM TƯƠNG ỨNG
        $redirectRoute = ($loaiPhim === 'phim_bo') ? 'phim.phim_bo' : 'phim.phim_le';
        return redirect()->route($redirectRoute)->with('success', 'Xóa phim thành công!');
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
            // 'trailer' => 'nullable|mimes:mp4,mkv,avi,mov,flv|max:51200',
            'trailer_type' => 'required|in:file,url', // Giả sử người dùng phải chọn lại
            'trailer_file' => 'nullable|mimes:mp4,mkv,avi,mov,flv|max:51200',
            'trailer_url' => 'nullable|url|max:255',
            // 'video' chỉ được gửi nếu là phim lẻ
            // 'video' => $phim->loai === 'phim_le' ? 'nullable|mimes:mp4,mov,ogg,qt|max:50000' : 'nullable',
            'video_type' => $phim->loai === 'phim_le' ? 'required|in:file,url' : 'nullable',
            'video_file' => ($phim->loai === 'phim_le' ? 'nullable' : 'nullable') . '|mimes:mp4,mov,ogg,qt|max:50000', // max 50MB
            'video_url' => ($phim->loai === 'phim_le' ? 'nullable|url|max:255' : 'nullable'),
            // 'so_tap' chỉ được gửi nếu là phim bộ
            'so_tap' => $phim->loai === 'phim_bo' ? 'nullable|integer|min:1' : 'nullable',
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

        // if ($request->hasFile('trailer')) {
        //     if ($phim->trailer && \Illuminate\Support\Facades\File::exists(public_path($phim->trailer))) {
        //         \Illuminate\Support\Facades\File::delete(public_path($phim->trailer));
        //     }
        //     $fileName = time() . '_' . $request->file('trailer')->getClientOriginalName();
        //     $request->file('trailer')->move($folder, $fileName);
        //     $trailerDb = $dbPath . '/' . $fileName;
        // }
        // *** BẮT ĐẦU CODE MỚI XỬ LÝ CẬP NHẬT TRAILER ***
        $trailerDb = $phim->trailer; // Giữ giá trị cũ làm mặc định

        // Hàm kiểm tra xem một chuỗi có phải là URL không
        $isUrl = function ($string) {
            return filter_var($string, FILTER_VALIDATE_URL) !== false;
        };

        if ($request->trailer_type === 'file' && $request->hasFile('trailer_file')) {
            // Nếu trailer cũ là file (không phải URL), thì xóa nó đi
            if ($phim->trailer && !$isUrl($phim->trailer) && File::exists(public_path($phim->trailer))) {
                File::delete(public_path($phim->trailer));
            }
            // Upload file mới
            $fileName = time() . '_' . $request->file('trailer_file')->getClientOriginalName();
            $request->file('trailer_file')->move($folder, $fileName);
            $trailerDb = $dbPath . '/' . $fileName;
        } elseif ($request->trailer_type === 'url' && $request->filled('trailer_url')) {
            // Xóa trailer cũ nếu nó là file (không phải URL)
            if ($phim->trailer && !$isUrl($phim->trailer) && File::exists(public_path($phim->trailer))) {
                File::delete(public_path($phim->trailer));
            }
            $trailerDb = $request->trailer_url;
        }
        // *** KẾT THÚC CODE MỚI ***

        // *** ĐIỀU CHỈNH: Xử lý Video (Phim Lẻ) hoặc Số tập (Phim Bộ) ***
        $videoDb = $phim->video; // Giữ giá trị cũ
        $soTapValue = $phim->so_tap; // Giữ giá trị cũ

        if ($phim->loai === 'phim_le') {
            if ($request->video_type === 'file' && $request->hasFile('video_file')) {
                // Xóa video cũ nếu nó là file
                if ($phim->video && !$isUrl($phim->video) && File::exists(public_path($phim->video))) {
                    File::delete(public_path($phim->video));
                }
                // Tải video mới
                $fileName = time() . '_' . $request->file('video_file')->getClientOriginalName();
                $request->file('video_file')->move($folder, $fileName);
                $videoDb = $dbPath . '/' . $fileName;
            } elseif ($request->video_type === 'url' && $request->filled('video_url')) {
                // Xóa video cũ nếu nó là file
                if ($phim->video && !$isUrl($phim->video) && File::exists(public_path($phim->video))) {
                    File::delete(public_path($phim->video));
                }
                $videoDb = $request->video_url;
            }
            $soTapValue = null; // Phim lẻ không có số tập
        } elseif ($phim->loai === 'phim_bo') {
            $soTapValue = $request->so_tap;
            // Phim bộ không có video chính, xóa file nếu có
            if ($phim->video && !$isUrl($phim->video) && File::exists(public_path($phim->video))) {
                File::delete(public_path($phim->video));
            }
            $videoDb = null;
        }

        // 3. Cập nhật thông tin vào DB
        $phim->update([
            'ten_phim' => $request->ten_phim,
            'mo_ta' => $request->mo_ta,
            'nam_phat_hanh' => $request->nam_phat_hanh,
            'anh_bia' => $anhBiaDb,
            // KHÔNG CẬP NHẬT 'loai' ở đây để tránh lỗi đường dẫn thư mục phức tạp
            // Nếu bạn muốn update 'loai', bạn phải xử lý đổi tên và di chuyển thư mục
            'trailer_type' => 'required|in:file,url',
            'trailer_file' => 'nullable|mimes:mp4,mkv,avi,mov,flv|max:51200',
            'trailer_url' => 'nullable|url|max:255',
            'video_type' => $phim->loai === 'phim_le' ? 'required|in:file,url' : 'nullable',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:50000',
            'video_url' => $phim->loai === 'phim_le' ? 'nullable|url|max:255' : 'nullable',
            'so_tap' => $soTapValue,    // Cập nhật số tập
            'thoi_luong' => $request->thoi_luong,
            'trang_thai' => $trangThaiValue,
            'hien_thi' => $hienThiValue,
            // 'duong_dan' => null, // Giữ nguyên null hoặc cập nhật nếu cần
        ]);

        // 4. Đồng bộ thể loại (sync sẽ xóa cái cũ và thêm cái mới)
        $phim->theloais()->sync($request->theloai);

        // CHUYỂN HƯỚNG VỀ DANH SÁCH PHIM TƯƠNG ỨNG
        $redirectRoute = ($phim->loai === 'phim_bo') ? 'phim.phim_bo' : 'phim.phim_le';
        return redirect()->route($redirectRoute)->with('success', 'Cập nhật phim thành công!');
    }
    // public function show(Phim $phim)
    // {
    //     // TẢI THÊM MỐI QUAN HỆ 'taps' (danh sách tập phim)
    //     // để đảm bảo nó không bị null khi truy cập trong view
    //     $phim->load('taps');

    //     // Nếu bạn muốn lấy phim với các mối quan hệ khác nữa:
    //     // $phim = Phim::with('theloais', 'taps')->findOrFail($phim->id);

    //     return view('admin.phim.thong_tin', compact('phim'));
    // }
}
