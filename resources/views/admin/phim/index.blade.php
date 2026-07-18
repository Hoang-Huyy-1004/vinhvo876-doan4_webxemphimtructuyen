@extends('admin.layouts.app')

@section('content')
{{-- Bọc tiêu đề và nút lọc trong d-flex để chia sang 2 bên --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    {{-- Bên trái: Tiêu đề (thêm mb-0 để căn giữa đẹp hơn) --}}
    <h2 class="mb-0">Danh sách tất cả phim</h2>

    {{-- Bên phải: Nút lọc --}}
    <div class="dropdown">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownFilter" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-filter"></i> Lọc phim
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownFilter">
            <li>
                <h6 class="dropdown-header">Sắp xếp theo</h6>
            </li>
            <li><a class="dropdown-item {{ request('sort') == 'newest' ? 'active' : '' }}" href="{{ route('phim.index', ['sort' => 'newest']) }}">Mới nhất (Mặc định)</a></li>
            <li><a class="dropdown-item {{ request('sort') == 'oldest' ? 'active' : '' }}" href="{{ route('phim.index', ['sort' => 'oldest']) }}">Cũ nhất</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item {{ request('sort') == 'year_desc' ? 'active' : '' }}" href="{{ route('phim.index', ['sort' => 'year_desc']) }}">Năm phát hành (Mới -> Cũ)</a></li>
            <li><a class="dropdown-item {{ request('sort') == 'year_asc' ? 'active' : '' }}" href="{{ route('phim.index', ['sort' => 'year_asc']) }}">Năm phát hành (Cũ -> Mới)</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item {{ request('sort') == 'view_desc' ? 'active' : '' }}" href="{{ route('phim.index', ['sort' => 'view_desc']) }}">Lượt xem cao nhất</a></li>
            <li><a class="dropdown-item {{ request('sort') == 'view_asc' ? 'active' : '' }}" href="{{ route('phim.index', ['sort' => 'view_asc']) }}">Lượt xem thấp nhất</a></li>
        </ul>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr class="text-white text-center" style="background-color: #000;">
            <th style="width: 5%;">Ảnh bìa</th>
            <th style="width: 20%;">Tên phim</th>
            <th style="width: 15%;">Năm phát hành</th>
            <th style="width: 10%;">Lượt xem</th>
            <th style="width: 15%;">Loại phim</th>
            <th style="width: 5%;">Thể loại</th>
            <th style="width: 15%;">Ngày phát sóng</th>
        </tr>
    </thead>
    <tbody>
        @forelse($phims as $phim)
        <tr>
            <td><img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}" width="100"></td>
            <td>{{ $phim->ten_phim }}</td>
            <td class="text-center">{{ $phim->nam_phat_hanh }}</td>
            <td class="text-center">
                @if($phim->loai === 'phim_bo')
                {{ number_format($phim->taps->sum('view_tap')) }}
                @else
                {{ number_format($phim->views->tong_views ?? 0) }}
                @endif
            </td>
            <td>
                @foreach($phim->theloais as $tl)
                <span class="badge bg-primary text-white">{{ $tl->ten_the_loai }}</span>
                @endforeach
            </td>
            <td>
                @if($phim->loai === 'phim_bo')
                <span class="badge bg-success text-white">Phim Bộ</span>
                @else
                <span class="badge bg-info text-white">Phim Lẻ</span>
                @endif
            </td>
            <td class="text-center">{{ $phim->created_at->format('d/m/Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Chưa có phim bộ nào</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection