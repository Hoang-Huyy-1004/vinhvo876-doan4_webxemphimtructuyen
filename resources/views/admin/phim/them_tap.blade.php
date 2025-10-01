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

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Upload Video mới (mp4, mov, ogg | Max 500MB)</label>
                        <input type="file" name="video" class="form-control" accept="video/*">
                        <small class="text-danger">Upload file mới sẽ thay thế file cũ (nếu có).</small>
                    </div>

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
