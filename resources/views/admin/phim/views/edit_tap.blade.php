@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Sửa lượt xem: {{ $view->phim->ten_phim }}</h1>
    <div class="card shadow mb-4 border-left-primary">
        <div class="card-body">
            <form action="{{ route('views.update', $view->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="font-weight-bold">Tên Phim</label>
                    <input type="text" class="form-control" value="{{ $view->phim->ten_phim }}" disabled>
                </div>
                
                <div class="mb-3">
                    <label class="font-weight-bold text-primary">Tổng lượt xem (Views)</label>
                    <input type="number" name="tong_views" class="form-control font-weight-bold" 
                           value="{{ $view->tong_views }}" min="0">
                </div>
                
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="{{ route('phim.show', $view->phim_id) }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection