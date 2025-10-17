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
            'uploadOption' => 'required|in:file,url',
            'video' => 'nullable|file|mimes:mp4,mov,ogg|max:512000', // 500MB
            'video_url' => 'required_if:uploadOption,url|nullable|url',
            'trang_thai' => 'required|in:cong_khai,nhap',
        ], [
            'video.mimes' => 'Định dạng video không hợp lệ (chỉ chấp nhận mp4, mov, ogg).',
            'video.max' => 'Kích thước video tối đa là 500MB.',
            'trang_thai.required' => 'Trạng thái là bắt buộc.',
            'uploadOption.required' => 'Bạn phải chọn phương thức tải lên.',
            'video.required_if' => 'Vui lòng chọn một tệp video để tải lên.',
            'video_url.required_if' => 'Vui lòng nhập URL của video.',
            'video_url.url' => 'Định dạng URL không hợp lệ.',
        ]);

        // Kiểm tra quan hệ phim-tap
        if ($tapPhim->phim_id !== $phim->id) {
            return redirect()->route('phim.show', $phim->id)
                ->with('error', 'Tập phim không thuộc về phim này.');
        }

        $videoDb = $tapPhim->video; // giữ đường dẫn cũ nếu không upload

        // Kiểm tra xem video cũ có phải là một tệp lưu trên server hay không (không phải URL)
        $isOldVideoAFile = $tapPhim->video && !Str::startsWith($tapPhim->video, ['http://', 'https://']);

        if ($request->uploadOption === 'url') {
            // Nếu người dùng đã nhập một URL mới
            if ($request->filled('video_url')) {
                // Nếu video cũ là một tệp trên server, hãy xóa nó đi để dọn dẹp dung lượng
                if ($isOldVideoAFile && File::exists(public_path($tapPhim->video))) {
                    try {
                        File::delete(public_path($tapPhim->video));
                    } catch (\Throwable $e) {
                        // Bỏ qua lỗi nếu không xóa được file, tránh làm sập chương trình
                    }
                }
                // Cập nhật biến $videoDb bằng URL mới
                $videoDb = $request->video_url;
            }
        } elseif ($request->uploadOption === 'file') {
            // Nếu người dùng đã tải lên một tệp video mới
            if ($request->hasFile('video')) {
                // Tương tự, nếu video cũ là tệp, xóa nó đi
                if ($isOldVideoAFile && File::exists(public_path($tapPhim->video))) {
                    try {
                        File::delete(public_path($tapPhim->video));
                    } catch (\Throwable $e) {
                        // Bỏ qua lỗi xóa
                    }
                }

                $file = $request->file('video');

                // Tạo tên tệp an toàn để tránh trùng lặp và lỗi ký tự
                $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeBase = Str::slug($baseName, '_') ?: 'video';
                $fileName = time() . '_' . $safeBase . '.' . $file->getClientOriginalExtension();

                // Xác định tên thư mục của phim
                $folderName = $phim->tenThuMuc ?? $phim->ten_thu_muc ?? $phim->thu_muc ?? $phim->slug ?? Str::slug($phim->ten_phim, '_');

                // Tạo đường dẫn tương đối đến thư mục chứa các tập phim
                $tapFolderRelative = 'img/ds_phim/ds_phim_bo/' . $folderName . '/ds_tap_phim';
                $publicFolder = public_path($tapFolderRelative);

                // Tạo thư mục nếu nó chưa tồn tại
                File::makeDirectory($publicFolder, 0755, true, true);

                // Di chuyển tệp video mới vào thư mục đích
                $file->move($publicFolder, $fileName);

                // Cập nhật biến $videoDb bằng đường dẫn tương đối của tệp mới
                $videoDb = $tapFolderRelative . '/' . $fileName;
            }
        }

        // Cập nhật DB
        $tapPhim->video = $videoDb;
        $tapPhim->trang_thai = $request->trang_thai;
        $tapPhim->save();

        return redirect()->route('phim.show', $phim->id)
            ->with('success', 'Cập nhật Tập ' . $tapPhim->tap . ' thành công!');
    }
}
