@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Tiêu đề trang --}}
    <h1 class="h3 mb-4 text-gray-800">
        Sửa lượt xem: {{ $tap->phim->ten_phim ?? 'Phim' }} - Tập {{ $tap->tap }}
    </h1>

    <div class="card shadow mb-4 border-left-info">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Thông tin lượt xem tập phim</h6>
        </div>
        <div class="card-body">
            
            {{-- Form cập nhật cho TẬP PHIM (Bảng tap_phim) --}}
            <form action="{{ route('views.tap.update', $tap->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Hiển thị tên phim (Chỉ đọc) --}}
                <div class="mb-3">
                    <label class="font-weight-bold">Tên Phim</label>
                    <input type="text" class="form-control" 
                           value="{{ $tap->phim->ten_phim ?? 'N/A' }}" disabled>
                </div>

                {{-- Hiển thị số tập (Chỉ đọc) --}}
                <div class="mb-3">
                    <label class="font-weight-bold">Tập số</label>
                    <input type="text" class="form-control" 
                           value="{{ $tap->tap }}" disabled>
                </div>

                {{-- Ô nhập lượt xem --}}
                <div class="mb-3">
                    <label for="view_tap" class="font-weight-bold text-info" style="font-size: 1.2rem;">
                        Lượt xem tập này (Views)
                    </label>
                    {{-- Lưu ý: value dùng $tap->view theo đúng database --}}
                    <input type="number" name="view_tap" id="view_tap" 
                           class="form-control form-control-lg font-weight-bold text-info" 
                           value="{{ old('view_tap', $tap->view_tap) }}" min="0" required>
                    <small class="text-muted">Nhập số lượt xem hiển thị cho tập {{ $tap->tap }}.</small>
                </div>

                {{-- Các nút thao tác --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50"><i class="fas fa-save"></i></span>
                        <span class="text">Lưu thay đổi</span>
                    </button>
                    
                    {{-- Quay lại trang chi tiết phim --}}
                    <a href="{{ route('phim.show', $tap->phim_id) }}" class="btn btn-secondary">
                        Hủy bỏ
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection