@extends('admin.layouts.app')

@section('content')

<h2 class="mb-4 text-primary">Chỉnh sửa Tập Phim: {{ $tapPhim->phim->ten_phim }} - Tập {{ $tapPhim->tap }}</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $err)
        <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Form SỬA tập phim, dùng method PUT --}}
<form action="{{ route('phim.tapphim.update', ['phim' => $tapPhim->phim_id, 'tapPhim' => $tapPhim->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') {{-- Bắt buộc phải dùng PUT hoặc PATCH cho chức năng Update --}}

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">Thông tin Tập Phim</div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tên phim / Tên tập</label>
                        {{-- Hiển thị thông tin tên tập, không cho sửa tên (vì tên tập được tạo tự động) --}}
                        <input type="text" class="form-control" value="{{ $tapPhim->phim->ten_phim }} - Tập {{ $tapPhim->tap }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Video hiện tại</label>
                        @if($tapPhim->video)
                        <div class="p-2">
                            <a href="{{ asset($tapPhim->video) }}"></a>
                        </div>
                        <video controls style="max-width: 100%; max-height: 200px;">
                            <source src="{{ asset($tapPhim->video) }}" type="video/mp4">
                            Trình duyệt của bạn không hỗ trợ thẻ video.
                        </video>
                        @else
                        <div class="alert alert-warning p-2">Chưa có video nào được upload cho tập này.</div>
                        @endif
                    </div>
                </div>

                <!-- đổi tập -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Chọn phương thức tải lên:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="uploadOption" id="uploadFile" value="file" checked>
                            <label class="form-check-label" for="uploadFile">
                                Tải video mới lên (mp4, mov, ogg | Tối đa 500MB)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="uploadOption" id="uploadUrl" value="url">
                            <label class="form-check-label" for="uploadUrl">
                                Sử dụng URL của video
                            </label>
                        </div>
                    </div>

                    <div class="mb-3" id="fileInputContainer">
                        <label class="form-label">Video mới</label>
                        <input type="file" name="video" class="form-control" accept="video/*">
                        <small class="text-danger">Tải lên tệp mới sẽ thay thế tệp cũ (nếu có).</small>
                    </div>

                    <div class="mb-3" id="urlInputContainer" style="display: none;">
                        <label class="form-label">Video URL</label>
                        <input type="url" name="video_url" class="form-control" placeholder="https://example.com/video.mp4">
                        <small class="text-danger">Cung cấp URL mới sẽ thay thế tệp cũ (nếu có).</small>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const uploadFileRadio = document.getElementById('uploadFile');
                            const uploadUrlRadio = document.getElementById('uploadUrl');
                            const fileInputContainer = document.getElementById('fileInputContainer');
                            const urlInputContainer = document.getElementById('urlInputContainer');

                            uploadFileRadio.addEventListener('change', function() {
                                if (this.checked) {
                                    fileInputContainer.style.display = 'block';
                                    urlInputContainer.style.display = 'none';
                                }
                            });

                            uploadUrlRadio.addEventListener('change', function() {
                                if (this.checked) {
                                    fileInputContainer.style.display = 'none';
                                    urlInputContainer.style.display = 'block';
                                }
                            });
                        });
                    </script>

                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="trang_thai" class="form-select" required>
                            <option value="cong_khai" {{ $tapPhim->trang_thai == 'cong_khai' ? 'selected' : '' }}>Công khai</option>
                            <option value="nhap" {{ $tapPhim->trang_thai == 'nhap' ? 'selected' : '' }}>Nháp</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Cập nhật tập phim</button>
            <a href="{{ route('phim.show', $tapPhim->phim_id) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại chi tiết phim</a>
        </div>
    </div>

</form>

@endsection