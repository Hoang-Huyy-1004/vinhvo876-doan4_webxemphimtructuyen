@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-4">Danh sách phim bộ</h2>
    <div class="dropdown">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownFilter" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-filter"></i> Lọc phim
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownFilter">
            <li>
                <h6 class="dropdown-header">Sắp xếp theo</h6>
            </li>
            <li><a class="dropdown-item {{ request('sort') == 'newest' ? 'active' : '' }}" href="{{ route('phim.phim_bo', ['sort' => 'newest']) }}">Mới nhất (Mặc định)</a></li>
            <li><a class="dropdown-item {{ request('sort') == 'oldest' ? 'active' : '' }}" href="{{ route('phim.phim_bo', ['sort' => 'oldest']) }}">Cũ nhất</a></li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li><a class="dropdown-item {{ request('sort') == 'year_desc' ? 'active' : '' }}" href="{{ route('phim.phim_bo', ['sort' => 'year_desc']) }}">Năm phát hành (Mới -> Cũ)</a></li>
            <li><a class="dropdown-item {{ request('sort') == 'year_asc' ? 'active' : '' }}" href="{{ route('phim.phim_bo', ['sort' => 'year_asc']) }}">Năm phát hành (Cũ -> Mới)</a></li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li><a class="dropdown-item {{ request('sort') == 'view_desc' ? 'active' : '' }}" href="{{ route('phim.phim_bo', ['sort' => 'view_desc']) }}">Lượt xem cao nhất</a></li>
            <li><a class="dropdown-item {{ request('sort') == 'view_asc' ? 'active' : '' }}" href="{{ route('phim.phim_bo', ['sort' => 'view_asc']) }}">Lượt xem thấp nhất</a></li>
        </ul>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr class="text-white text-center" style="background-color: #000;">
            <th style="width: 5%;">Ảnh bìa</th>
            <th style="width: 20%;">Tên phim</th>
            <th style="width: 15%;">Năm phát hành</th>
            <th style="width: 10%;">Số tập</th>
            <th style="width: 10%;">Lượt xem</th>
            <th style="width: 10%;">Thể loại</th>
            <th style="width: 10%;">Trạng thái</th>
            <th style="width: 20%;">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($phims as $phim)
        <tr>
            <td class="text-center"><img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}" width="100"></td>
            <td>{{ $phim->ten_phim }}</td>
            <td class="text-center">{{ $phim->nam_phat_hanh }}</td>
            <td class="text-center">{{ $phim->so_tap }}</td>
            <td class="text-center">{{ number_format($phim->taps->sum('view_tap')) }}</td>
            <td>
                @foreach($phim->theloais as $tl)
                <span class="badge bg-primary text-white">{{ $tl->ten_the_loai }}</span>
                @endforeach
            </td>
            <td class="text-center">
                @if($phim->trang_thai === 'cong_khai')
                <span class="badge bg-success text-white">Công khai</span>
                @else
                <span class="badge bg-danger text-white">Nháp</span>
                @endif
            </td>
            <td class="text-center">
                <!-- Nút Sửa: Dùng route phim.edit -->
                <a href="{{ route('phim.edit', $phim->id) }}" class="btn btn-warning btn-sm">Sửa</a>

                <!-- Form Xóa: Dùng route phim.destroy -->
                <form action="{{ route('phim.destroy', $phim->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận xóa phim: {{ $phim->ten_phim }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                </form>

                <a href="{{ route('phim.show', $phim->id) }}" class="btn btn-info btn-sm">Thông tin</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Chưa có phim bộ nào</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection