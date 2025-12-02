@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Sửa lượt xem: Tập {{ $tap->tap }}</h1>
    <div class="card shadow mb-4 border-left-info">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Phim: {{ $tap->phim->ten_phim }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('views.tap.update', $tap->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Tên tập</label>
                    <input type="text" class="form-control" value="{{ $tap->ten_phim }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="view_tap" class="form-label font-weight-bold text-primary" style="font-size: 1.2rem;">
                        Số lượt xem (Views)
                    </label>
                    <input type="number" name="view_tap" id="view_tap" 
                           class="form-control form-control-lg font-weight-bold text-primary" 
                           value="{{ old('view_tap', $tap->view_tap) }}" min="0">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50"><i class="fas fa-save"></i></span>
                        <span class="text">Lưu View Tập</span>
                    </button>
                    <a href="{{ route('phim.show', $tap->phim_id) }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection