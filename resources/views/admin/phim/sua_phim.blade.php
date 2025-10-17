@extends('admin.layouts.app')

@section('content')
<h2 class="mb-4">Chỉnh sửa phim: {{ $phim->ten_phim }}</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $err)
        <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

{{-- FORM SỬ DỤNG PHƯƠNG THỨC PUT/PATCH VÀ ENCTYPE CHO FILE --}}
<form action="{{ route('phim.update', $phim->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Tên phim --}}
    <div class="mb-3">
        <label class="form-label">Tên phim</label>
        <input type="text" name="ten_phim" class="form-control"
            value="{{ old('ten_phim', $phim->ten_phim) }}" required>
    </div>

    {{-- Mô tả --}}
    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="mo_ta" class="form-control">{{ old('mo_ta', $phim->mo_ta) }}</textarea>
    </div>

    {{-- Năm phát hành --}}
    <div class="mb-3">
        <label class="form-label">Năm phát hành</label>
        <input type="number" name="nam_phat_hanh" class="form-control"
            value="{{ old('nam_phat_hanh', $phim->nam_phat_hanh) }}">
    </div>

    {{-- Ảnh bìa hiện tại & Input file mới --}}
    <div class="mb-3">
        <label class="form-label d-block">Ảnh bìa hiện tại</label>
        @if ($phim->anh_bia)
        <img src="{{ asset($phim->anh_bia) }}" alt="Ảnh bìa" style="max-width: 150px; height: auto; margin-bottom: 10px;">
        @else
        <p>Chưa có ảnh bìa.</p>
        @endif

        <label class="form-label">Cập nhật Ảnh bìa (Không bắt buộc)</label>
        <input type="file" name="anh_bia" class="form-control" accept="image/*">
    </div>

    {{-- Loại phim --}}
    <div class="mb-3">
        <label class="form-label">Loại phim</label>
        <select name="loai" class="form-select" required>
            {{-- Lưu ý: DB lưu 'phim_le'/'phim_bo', Form dùng 'le'/'bo'. Cần kiểm tra đúng giá trị --}}
            <option value="le" @selected(old('loai', $phim->loai) == 'phim_le')>Phim lẻ</option>
            <option value="bo" @selected(old('loai', $phim->loai) == 'phim_bo')>Phim bộ</option>
        </select>
    </div>

    {{-- Thể loại phim (Checkbox) --}}
    <div class="mb-3">
        <label class="form-label">Thể loại phim</label>
        <?php
        // Lấy ra mảng ID của các thể loại đã được chọn của phim này
        $phimTheLoaiIds = $phim->theloais->pluck('id')->toArray();
        ?>
        <div class="row">
            @foreach($theloais as $tl)
            <div class="col-md-3 col-sm-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="theloai[]" value="{{ $tl->id }}" id="theloai{{ $tl->id }}"
                        {{-- Kiểm tra nếu ID thể loại có trong mảng thể loại của phim, hoặc đã được chọn qua old() --}}
                        @checked(in_array($tl->id, old('theloai', $phimTheLoaiIds ?? [])))
                    >
                    <label class="form-check-label" for="theloai{{ $tl->id }}">
                        {{ $tl->ten_the_loai }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Trailer --}}
    <div class="mb-3">
        <label class="form-label">Trailer hiện tại:</label>
        <p>{{ $phim->trailer ? basename($phim->trailer) : 'Chưa có trailer' }}</p>
        <hr>

        <label class="form-label">Cập nhật Trailer mới (Không bắt buộc)</label>

        {{-- Lựa chọn loại trailer --}}
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="trailer_type" id="trailer_none_radio" value="none" checked>
            <label class="form-check-label" for="trailer_none_radio">Không thay đổi</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="trailer_type" id="trailer_file_radio" value="file">
            <label class="form-check-label" for="trailer_file_radio">Upload File mới</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="trailer_type" id="trailer_url_radio" value="url">
            <label class="form-check-label" for="trailer_url_radio">Nhập URL mới</label>
        </div>

        {{-- Input cho Upload File (ẩn mặc định) --}}
        <div id="trailer_file_field" class="mt-2" style="display: none;">
            <input type="file" name="trailer_file" class="form-control" accept="video/*">
        </div>

        {{-- Input cho URL (ẩn mặc định) --}}
        <div id="trailer_url_field" class="mt-2" style="display: none;">
            <input type="url" name="trailer_url" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
        </div>
    </div>

    {{-- SCRIPT ĐIỀU KHIỂN ẨN/HIỆN --}}
    {{-- Đảm bảo chỉ có 1 script này ở cuối file blade của bạn --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tìm các element liên quan đến trailer
            const trailerTypeRadios = document.querySelectorAll('input[name="trailer_type"]');
            const fileField = document.getElementById('trailer_file_field');
            const urlField = document.getElementById('trailer_url_field');

            function updateTrailerFields() {
                const selectedValue = document.querySelector('input[name="trailer_type"]:checked').value;

                if (selectedValue === 'file') {
                    fileField.style.display = 'block';
                    urlField.style.display = 'none';
                } else if (selectedValue === 'url') {
                    fileField.style.display = 'none';
                    urlField.style.display = 'block';
                } else { // 'none'
                    fileField.style.display = 'none';
                    urlField.style.display = 'none';
                }
            }

            // Gắn sự kiện 'change' cho mỗi radio button
            trailerTypeRadios.forEach(radio => {
                radio.addEventListener('change', updateTrailerFields);
            });

            // Chạy lần đầu khi tải trang để ẩn các trường không cần thiết
            updateTrailerFields();
        });
    </script>

    {{-- Khối điều kiện: Video cho Phim Lẻ, Số tập cho Phim Bộ --}}
    @if ($phim->loai === 'phim_le')
    {{-- Dành cho Phim Lẻ: Video --}}
    <div class="mb-3">
        <label class="form-label">Video hiện tại (Phim Lẻ):</label>
        <p>{{ $phim->video ? basename($phim->video) : 'Chưa có video' }}</p>
        <label class="form-label">Cập nhật Video (Không bắt buộc)</label>
        <input type="file" name="video" class="form-control" accept="video/*">
    </div>
    @elseif ($phim->loai === 'phim_bo')
    {{-- Dành cho Phim Bộ: Số tập --}}
    <div class="mb-3">
        <label class="form-label">Số tập (Phim Bộ)</label>
        {{-- Đảm bảo trường này được nhập nếu là phim bộ --}}
        <input type="number" name="so_tap" class="form-control" value="{{ old('so_tap', $phim->so_tap) }}" min="1">
        <div class="form-text">Số tập hiện tại: {{ $phim->so_tap ?? 'Chưa rõ' }}</div>
    </div>
    @endif
    {{-- Hết khối điều kiện --}}


    {{-- Thời lượng --}}
    <div class="mb-3">
        <label class="form-label">Thời lượng</label>
        <input type="text" name="thoi_luong" class="form-control" placeholder="VD: 120 phút"
            value="{{ old('thoi_luong', $phim->thoi_luong) }}">
    </div>

    {{-- Trạng thái --}}
    <div class="mb-3">
        <label class="form-label">Trạng thái</label>
        <select name="trang_thai" class="form-select">
            <option value="cong_khai" @selected(old('trang_thai', $phim->trang_thai) == 'cong_khai')>Công khai</option>
            <option value="nhap" @selected(old('trang_thai', $phim->trang_thai) == 'nhap')>Nháp</option>
        </select>
    </div>

    {{-- Hiển thị --}}
    <div class="mb-3">
        <label for="hien_thi" class="form-label">Hiển thị</label>
        <select name="hien_thi" id="hien_thi" class="form-select">
            <option value="binh_thuong" @selected(old('hien_thi', $phim->hien_thi) == 'binh_thuong')>Bình thường</option>
            <option value="noi_bat" @selected(old('hien_thi', $phim->hien_thi) == 'noi_bat')>Nổi bật</option>
            <option value="moi" @selected(old('hien_thi', $phim->hien_thi) == 'moi')>Phim mới</option>
            <option value="hot" @selected(old('hien_thi', $phim->hien_thi) == 'hot')>Phim hot</option>
        </select>
    </div>


    <button type="submit" class="btn btn-primary">Cập nhật phim</button>
</form>
@endsection