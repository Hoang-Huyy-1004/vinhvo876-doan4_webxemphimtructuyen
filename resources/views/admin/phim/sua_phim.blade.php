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
    <!-- <div class="mb-3">
        <label class="form-label">Năm phát hành</label>
        <input type="number" name="nam_phat_hanh" class="form-control"
            value="{{ old('nam_phat_hanh', $phim->nam_phat_hanh) }}">
    </div> -->
    <!-- {{-- Năm phát hành --}} -->
    <div class="mb-3">
        <label class="form-label">Năm phát hành</label>
        {{-- Dùng <select class="form-control"> để có giao diện input và chức năng cuộn/chọn --}}
        <select name="nam_phat_hanh" class="form-control">
            <option value="">-- Chọn năm --</option>
            <?php 
                $endYear = date('Y') + 1; // 2026 (năm hiện tại là 2025)
                $startYear = 2008;

                $selectedYear = old('nam_phat_hanh', $phim->nam_phat_hanh);
                
                // Lặp từ năm mới nhất về năm cũ nhất
                for ($year = $endYear; $year >= $startYear; $year--) {
                    $selected = ($selectedYear == $year) ? 'selected' : '';
                    echo "<option value=\"{$year}\" {$selected}>{$year}</option>";
                }
            ?>
        </select>
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

    <!-- {{-- Trailer --}}
    <div class="mb-3">
        <label class="form-label">Trailer hiện tại:</label>
        <p>{{ $phim->trailer ? basename($phim->trailer) : 'Chưa có trailer' }}</p>
        <label class="form-label">Cập nhật Trailer (Không bắt buộc)</label>
        <input type="file" name="trailer" class="form-control" accept="video/*">
    </div> -->

    {{-- Trailer --}}
    <div class="mb-3">
        <label class="form-label">Trailer hiện tại:</label>
        {{-- Hiển thị thông tin trailer hiện tại (file hoặc URL) --}}
        <p>{{ $phim->trailer ? basename($phim->trailer) : 'Chưa có trailer' }}</p>

        <label class="form-label d-block">Cập nhật Trailer (Không bắt buộc)</label>

        {{-- Lựa chọn loại trailer (File/URL) --}}
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="trailer_type" id="trailer_file_radio_edit" value="file" @checked(!filter_var(old('trailer_type', $phim->trailer), FILTER_VALIDATE_URL))>
            <label class="form-check-label" for="trailer_file_radio_edit">Upload File</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="trailer_type" id="trailer_url_radio_edit" value="url" @checked(filter_var(old('trailer_type', $phim->trailer), FILTER_VALIDATE_URL))>
            <label class="form-check-label" for="trailer_url_radio_edit">Nhập URL</label>
        </div>

        {{-- Input cho Upload File --}}
        <div id="trailer_file_field_edit" class="mt-2" @if(filter_var($phim->trailer, FILTER_VALIDATE_URL)) style="display: none;" @endif>
            <input type="file" name="trailer_file" class="form-control" accept="video/*">
        </div>

        {{-- Input cho URL --}}
        <div id="trailer_url_field_edit" class="mt-2" @if(!filter_var($phim->trailer, FILTER_VALIDATE_URL)) style="display: none;" @endif>
            <input type="url" name="trailer_url" class="form-control" placeholder="https://" value="{{ old('trailer_url', filter_var($phim->trailer, FILTER_VALIDATE_URL) ? $phim->trailer : '') }}">
        </div>
    </div>

    <!-- {{-- Khối điều kiện: Video cho Phim Lẻ, Số tập cho Phim Bộ --}}
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
    {{-- Hết khối điều kiện --}} -->

    @if ($phim->loai === 'phim_le')
    {{-- Dành cho Phim Lẻ: Video --}}
    <div class="mb-3" id="field_video_edit">

        <?php
        // Định nghĩa biến để kiểm tra video hiện tại là URL hay File
        $isVideoUrl = filter_var($phim->video, FILTER_VALIDATE_URL);
        // Xác định trạng thái checked/visibility cuối cùng (ưu tiên old() nếu có)
        $isCurrentlyUrl = old('video_type') === 'url' || (old('video_type') === null && $isVideoUrl);
        ?>

        <label class="form-label">Video hiện tại (Phim Lẻ):</label>
        {{-- GIỮ NGUYÊN CẤU TRÚC HIỂN THỊ CŨ CỦA BẠN --}}
        <p>{{ $phim->video ? basename($phim->video) : 'Chưa có video' }}</p>

        <label class="form-label d-block">Cập nhật Video (Không bắt buộc)</label>

        {{-- Lựa chọn loại video (File/URL) --}}
        <div class="form-check form-check-inline">
            {{-- Dùng $isCurrentlyUrl để xác định trạng thái checked --}}
            <input class="form-check-input" type="radio" name="video_type" id="video_file_radio_edit" value="file" @checked(!$isCurrentlyUrl)>
            <label class="form-check-label" for="video_file_radio_edit">Upload File</label>
        </div>
        <div class="form-check form-check-inline">
            {{-- Dùng $isCurrentlyUrl để xác định trạng thái checked --}}
            <input class="form-check-input" type="radio" name="video_type" id="video_url_radio_edit" value="url" @checked($isCurrentlyUrl)>
            <label class="form-check-label" for="video_url_radio_edit">Nhập URL</label>
        </div>

        {{-- Input cho Upload File --}}
        {{-- Ẩn/hiện dựa trên $isCurrentlyUrl --}}
        <div id="video_file_field_edit" class="mt-2" @if($isCurrentlyUrl) style="display: none;" @endif>
            <input type="file" name="video_file" class="form-control" accept="video/*">
        </div>

        {{-- Input cho URL --}}
        {{-- Ẩn/hiện dựa trên $isCurrentlyUrl và giữ giá trị cũ cho URL nếu là URL --}}
        <div id="video_url_field_edit" class="mt-2" @if(!$isCurrentlyUrl) style="display: none;" @endif>
            <input type="url" name="video_url" class="form-control" placeholder="https://" value="{{ old('video_url', $isVideoUrl ? $phim->video : '') }}">
        </div>
    </div>
    @elseif ($phim->loai === 'phim_bo')
    {{-- Dành cho Phim Bộ: Số tập --}}
    <div class="mb-3">
        <label class="form-label">Số tập (Phim Bộ)</label>
        <input type="number" name="so_tap" class="form-control" value="{{ old('so_tap', $phim->so_tap) }}" min="1">
        <div class="form-text">Số tập hiện tại: {{ $phim->so_tap ?? 'Chưa rõ' }}</div>
    </div>
    @endif


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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hàm tái sử dụng để ẩn/hiện các trường file/url
        function setupToggleFields(config) {
            const radioButtons = document.querySelectorAll(`input[name="${config.radioName}"]`);
            const fileField = document.getElementById(config.fileFieldId);
            const urlField = document.getElementById(config.urlFieldId);

            if (!radioButtons.length || !fileField || !urlField) {
                return;
            }

            function updateVisibility() {
                const selectedRadio = document.querySelector(`input[name="${config.radioName}"]:checked`);
                const selectedValue = selectedRadio ? selectedRadio.value : 'file'; // Mặc định là file

                fileField.style.display = (selectedValue === 'file') ? 'block' : 'none';
                urlField.style.display = (selectedValue === 'url') ? 'block' : 'none';

                // Cần đảm bảo chỉ một trong hai trường có thể có dữ liệu (dù không bắt buộc nhập)
                // Tuy nhiên, đối với cập nhật, chúng ta chỉ cần quản lý việc ẩn/hiện
            }

            radioButtons.forEach(radio => radio.addEventListener('change', updateVisibility));
            updateVisibility(); // Chạy lần đầu để có trạng thái đúng
        }

        // Áp dụng hàm cho phần Trailer
        setupToggleFields({
            radioName: 'trailer_type',
            fileFieldId: 'trailer_file_field_edit',
            urlFieldId: 'trailer_url_field_edit'
        });

        // Áp dụng hàm cho phần Video (chỉ khi là phim lẻ)
        const isPhimLe = "{{ $phim->loai }}" === 'phim_le';
        if (isPhimLe) {
            setupToggleFields({
                radioName: 'video_type',
                fileFieldId: 'video_file_field_edit',
                urlFieldId: 'video_url_field_edit'
            });
        }

        // Lưu ý: Trong form chỉnh sửa, không cần thay đổi required như form thêm mới 
        // vì các trường này đều là "Không bắt buộc" khi cập nhật.
    });
</script>

@endsection