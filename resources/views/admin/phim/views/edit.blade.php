@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Tiêu đề trang --}}
    <h1 class="h3 mb-4 text-gray-800">
        Sửa lượt xem: {{ $view->phim->ten_phim ?? 'Phim không tồn tại' }}
    </h1>

    <div class="card shadow mb-4 border-left-info">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Thông tin lượt xem</h6>
        </div>
        <div class="card-body">
            
            {{-- Form cập nhật cho PHIM LẺ (Bảng views) --}}
            <form action="{{ route('views.update', $view->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Hiển thị tên phim (Chỉ đọc) --}}
                <div class="mb-3">
                    <label class="font-weight-bold">Tên Phim</label>
                    <input type="text" class="form-control" 
                           value="{{ $view->phim->ten_phim ?? 'N/A' }}" disabled>
                </div>

                {{-- Ô nhập tổng lượt xem --}}
                <div class="mb-3">
                    <label for="tong_views" class="font-weight-bold text-info" style="font-size: 1.2rem;">
                        Tổng lượt xem (Views)
                    </label>
                    <input type="number" name="tong_views" id="tong_views" 
                           class="form-control form-control-lg font-weight-bold text-info" 
                           value="{{ old('tong_views', $view->tong_views) }}" min="0" required>
                    <small class="text-muted">Nhập số lượt xem bạn muốn hiển thị cho phim này.</small>
                </div>

                {{-- Các nút thao tác --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50"><i class="fas fa-save"></i></span>
                        <span class="text">Lưu thay đổi</span>
                    </button>
                    
                    {{-- Quay lại trang chi tiết phim --}}
                    <a href="{{ route('phim.show', $view->phim_id) }}" class="btn btn-secondary">
                        Hủy bỏ
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection