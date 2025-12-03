@extends('admin.layouts.app')

@section('content')
<h2 class="mb-4">Danh sách tất cả phim</h2>

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