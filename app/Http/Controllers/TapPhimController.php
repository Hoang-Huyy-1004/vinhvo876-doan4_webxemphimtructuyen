<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\TapPhim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TapPhimController extends Controller
{
    /**
     * Hiển thị form chỉnh sửa một tập phim.
     * Route model binding: (Phim $phim, TapPhim $tapPhim)
     */
    public function edit(Phim $phim, TapPhim $tapPhim)
    {
        // Đảm bảo tập phim thuộc về phim này
        if ($tapPhim->phim_id !== $phim->id) {
            return redirect()->route('phim.show', $phim->id)
                ->with('error', 'Tập phim không thuộc về phim này.');
        }

        // Trả về view (cập nhật) — truyền cả $phim lẫn $tapPhim
        return view('admin.phim.them_tap', compact('phim', 'tapPhim'));
    }

    /**
     * Cập nhật thông tin và video của một tập phim.
     */

    public function update(Request $request, Phim $phim, TapPhim $tapPhim)
    {
        // Validate
        $request->validate([
            'video' => 'nullable|file|mimes:mp4,mov,ogg|max:512000', // 500MB
            'trang_thai' => 'required|in:cong_khai,nhap',
        ], [
            'video.mimes' => 'Định dạng video không hợp lệ (chỉ chấp nhận mp4, mov, ogg).',
            'video.max' => 'Kích thước video tối đa là 500MB.',
            'trang_thai.required' => 'Trạng thái là bắt buộc.',
        ]);

        // Kiểm tra quan hệ phim-tap
        if ($tapPhim->phim_id !== $phim->id) {
            return redirect()->route('phim.show', $phim->id)
                ->with('error', 'Tập phim không thuộc về phim này.');
        }

        $videoDb = $tapPhim->video; // giữ đường dẫn cũ nếu không upload

        if ($request->hasFile('video')) {
            $file = $request->file('video');

            // Tên file an toàn
            $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeBase = Str::slug($baseName, '_') ?: 'video';
            $fileName = time() . '_' . $safeBase . '.' . $file->getClientOriginalExtension();

            // Lấy tên thư mục phim đã lưu (ưu tiên các trường có thể bạn lưu)
            $folderName = null;
            foreach (['tenThuMuc', 'ten_thu_muc', 'thu_muc', 'slug'] as $prop) {
                if (!empty($phim->{$prop})) {
                    $folderName = $phim->{$prop};
                    break;
                }
            }
            // Nếu không có trường lưu sẵn thì tạo slug giống khi bạn tạo phim (dấu gạch dưới)
            if (!$folderName) {
                $folderName = Str::slug($phim->ten_phim, '_');
            }

            // Đường dẫn tương đối tới thư mục ds_tap_phim của phim
            $tapFolderRelative = 'img/ds_phim/ds_phim_bo/' . $folderName . '/ds_tap_phim';
            $publicFolder = public_path($tapFolderRelative);

            // Tạo thư mục nếu thật sự chưa tồn tại (an toàn)
            if (!File::exists($publicFolder)) {
                File::makeDirectory($publicFolder, 0755, true);
            }

            // Xóa file cũ (nếu có)
            if (!empty($tapPhim->video) && File::exists(public_path($tapPhim->video))) {
                try {
                    File::delete(public_path($tapPhim->video));
                } catch (\Throwable $e) {
                    // bỏ qua lỗi xóa
                }
            }

            // Di chuyển file mới vào thư mục ds_tap_phim của phim
            $file->move($publicFolder, $fileName);

            // Lưu đường dẫn tương đối vào DB
            $videoDb = $tapFolderRelative . '/' . $fileName;
        }

        // Cập nhật DB
        $tapPhim->video = $videoDb;
        $tapPhim->trang_thai = $request->trang_thai;
        $tapPhim->save();

        return redirect()->route('phim.show', $phim->id)
            ->with('success', 'Cập nhật Tập ' . $tapPhim->tap . ' thành công!');
    }
}
