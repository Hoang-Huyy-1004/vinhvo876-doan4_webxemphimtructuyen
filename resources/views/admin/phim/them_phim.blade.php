@extends('admin.layouts.app')

@section('content')
<h2 class="mb-4">Thêm phim mới</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $err)
        <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('phim.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Tên phim</label>
        <input type="text" name="ten_phim" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="mo_ta" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Năm phát hành</label>
        <input type="number" name="nam_phat_hanh" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Ảnh bìa</label>
        <input type="file" name="anh_bia" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
        <label class="form-label">Loại phim</label>
        <select name="loai" id="loai_phim" class="form-select" required>
            <option value="le">Phim lẻ</option>
            <option value="bo">Phim bộ</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Thể loại phim</label>
        <div class="row">
            @foreach($theloais as $tl)
            <div class="col-md-3 col-sm-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="theloai[]" value="{{ $tl->id }}" id="theloai{{ $tl->id }}">
                    <label class="form-check-label" for="theloai{{ $tl->id }}">
                        {{ $tl->ten_the_loai }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- <div class="mb-3">
        <label class="form-label">Trailer</label>
        <input type="file" name="trailer" class="form-control" accept="video/*">
    </div> -->
    <div class="mb-3">
        <label class="form-label">Trailer</label>

        {{-- Lựa chọn loại trailer --}}
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="trailer_type" id="trailer_file_radio" value="file" checked>
            <label class="form-check-label" for="trailer_file_radio">Upload File</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="trailer_type" id="trailer_url_radio" value="url">
            <label class="form-check-label" for="trailer_url_radio">Nhập URL</label>
        </div>

        {{-- Input cho Upload File --}}
        <div id="trailer_file_field" class="mt-2">
            <input type="file" name="trailer_file" class="form-control" accept="video/*">
        </div>

        {{-- Input cho URL --}}
        <div id="trailer_url_field" class="mt-2" style="display: none;">
            <input type="url" name="trailer_url" class="form-control" placeholder="https://...">
        </div>
    </div>

    <!-- <div class="mb-3">
        <label class="form-label">Video</label>
        <input type="file" name="video" class="form-control" accept="video/*">
    </div> -->

    {{-- 1. Cho Phim LẺ (video file) --}}
    <!-- <div class="mb-3" id="field_video"> {{-- THÊM ID --}}
        <label class="form-label">Video (Phim lẻ)</label>
        <input type="file" name="video" class="form-control" accept="video/*">
    </div> -->
    {{-- Thay thế div này cho div#field_video cũ --}}
    <div class="mb-3" id="field_video">
        <label class="form-label">Video (Phim lẻ)</label>

        {{-- Lựa chọn loại video --}}
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="video_type" id="video_file_radio" value="file" checked>
            <label class="form-check-label" for="video_file_radio">Upload File</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="video_type" id="video_url_radio" value="url">
            <label class="form-check-label" for="video_url_radio">Nhập URL</label>
        </div>

        {{-- Input cho Upload File --}}
        <div id="video_file_field" class="mt-2">
            <input type="file" name="video_file" class="form-control" accept="video/*">
        </div>

        {{-- Input cho URL --}}
        <div id="video_url_field" class="mt-2" style="display: none;">
            <input type="url" name="video_url" class="form-control" placeholder="https://...">
        </div>
    </div>
    
    {{-- 2. Cho Phim BỘ (số tập) --}}
    <div class="mb-3" id="field_so_tap" style="display: none;"> {{-- THÊM ID và ẨN MẶC ĐỊNH --}}
        <label class="form-label">Số tập (Phim bộ)</label>
        <input type="number" name="so_tap" class="form-control" min="1" placeholder="Nhập tổng số tập">
    </div>


    <div class="mb-3">
        <label class="form-label">Thời lượng</label>
        <input type="text" name="thoi_luong" class="form-control" placeholder="VD: 120 phút">
    </div>

    <div class="mb-3">
        <label class="form-label">Trạng thái</label>
        <select name="trang_thai" class="form-select">
            <option value="cong_khai">Công khai</option>
            <option value="nhap">Nháp</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="hien_thi" class="form-label">Hiển thị</label>
        <select name="hien_thi" id="hien_thi" class="form-select">
            <option value="binh_thuong">Bình thường</option>
            <option value="noi_bat">Nổi bật</option>
            <option value="moi">Phim mới</option>
            <option value="hot">Phim hot</option>
        </select>
    </div>


    <button type="submit" class="btn btn-primary">Lưu phim</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loaiPhim = document.getElementById('loai_phim');
        const fieldVideo = document.getElementById('field_video');
        const fieldSoTap = document.getElementById('field_so_tap');
        const inputVideo = fieldVideo.querySelector('input[name="video"]');
        const inputSoTap = fieldSoTap.querySelector('input[name="so_tap"]');

        function toggleFields() {
            if (loaiPhim.value === 'bo') {
                // Phim Bộ: Ẩn Video, Hiện Số tập
                fieldVideo.style.display = 'none';
                inputVideo.removeAttribute('required'); // Bỏ required cho input file video

                fieldSoTap.style.display = 'block';
                inputSoTap.setAttribute('required', 'required'); // BẮT BUỘC nhập số tập
            } else {
                // Phim Lẻ: Hiện Video, Ẩn Số tập
                fieldVideo.style.display = 'block';
                inputVideo.setAttribute('required', 'required'); // BẮT BUỘC upload video phim lẻ

                fieldSoTap.style.display = 'none';
                inputSoTap.removeAttribute('required'); // Bỏ required cho input số tập
            }
        }

        // Chạy lần đầu tiên khi tải trang
        toggleFields();

        // Lắng nghe sự kiện thay đổi
        loaiPhim.addEventListener('change', toggleFields);
    });

    // {{-- XÓA HẾT CÁC SCRIPT CŨ VÀ THAY BẰNG SCRIPT NÀY --}}
    document.addEventListener('DOMContentLoaded', function () {
        // --- PHẦN 1: HÀM TÁI SỬ DỤNG ĐỂ ẨN/HIỆN CÁC TRƯỜNG FILE/URL ---
        function setupToggleFields(config) {
            const radioButtons = document.querySelectorAll(`input[name="${config.radioName}"]`);
            const fileField = document.getElementById(config.fileFieldId);
            const urlField = document.getElementById(config.urlFieldId);

            // Nếu không tìm thấy các element thì không làm gì cả
            if (!radioButtons.length || !fileField || !urlField) {
                return;
            }

            function updateVisibility() {
                const selectedValue = document.querySelector(`input[name="${config.radioName}"]:checked`).value;
                fileField.style.display = (selectedValue === 'file') ? 'block' : 'none';
                urlField.style.display = (selectedValue === 'url') ? 'block' : 'none';
            }

            radioButtons.forEach(radio => radio.addEventListener('change', updateVisibility));
            updateVisibility(); // Chạy lần đầu để có trạng thái đúng
        }

        // Áp dụng hàm cho phần Trailer
        setupToggleFields({
            radioName: 'trailer_type',
            fileFieldId: 'trailer_file_field',
            urlFieldId: 'trailer_url_field'
        });

        // Áp dụng hàm cho phần Video
        setupToggleFields({
            radioName: 'video_type',
            fileFieldId: 'video_file_field',
            urlFieldId: 'video_url_field'
        });


        // --- PHẦN 2: LOGIC ẨN/HIỆN DỰA TRÊN LOẠI PHIM (LẺ/BỘ) ---
        const loaiPhimSelect = document.getElementById('loai_phim');
        const fieldVideo = document.getElementById('field_video');
        const fieldSoTap = document.getElementById('field_so_tap');
        
        const inputVideoFile = document.querySelector('input[name="video_file"]');
        const inputVideoUrl = document.querySelector('input[name="video_url"]');
        const inputSoTap = document.querySelector('input[name="so_tap"]');

        function updateFormLayout() {
            if (loaiPhimSelect.value === 'bo') { // Nếu là Phim Bộ
                fieldVideo.style.display = 'none';
                fieldSoTap.style.display = 'block';

                // Bỏ bắt buộc nhập video
                inputVideoFile.removeAttribute('required');
                inputVideoUrl.removeAttribute('required');
                // Bắt buộc nhập số tập
                inputSoTap.setAttribute('required', 'required');

            } else { // Nếu là Phim Lẻ
                fieldVideo.style.display = 'block';
                fieldSoTap.style.display = 'none';
                
                // Bắt buộc nhập video (dựa theo lựa chọn file hoặc url)
                const selectedVideoType = document.querySelector('input[name="video_type"]:checked').value;
                if(selectedVideoType === 'file') {
                    inputVideoFile.setAttribute('required', 'required');
                    inputVideoUrl.removeAttribute('required');
                } else { // url
                    inputVideoFile.removeAttribute('required');
                    inputVideoUrl.setAttribute('required', 'required');
                }
                
                // Bỏ bắt buộc nhập số tập
                inputSoTap.removeAttribute('required');
            }
        }
        
        // Lắng nghe sự kiện thay đổi của cả Loại Phim và Loại Video
        loaiPhimSelect.addEventListener('change', updateFormLayout);
        document.querySelectorAll('input[name="video_type"]').forEach(radio => {
            radio.addEventListener('change', updateFormLayout);
        });

        // Chạy lần đầu khi tải trang
        updateFormLayout();
    });
</script>

@endsection