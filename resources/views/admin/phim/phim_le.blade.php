@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Danh sách phim lẻ</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr class="bg-primary text-white">
                <th>Ảnh bìa</th>
                <th>Tên phim</th>
                <th>Năm phát hành</th>
                <th>Thời lượng</th>
                <th>Thể loại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($phims as $phim)
                <tr>
                    <td> <img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}" width="100"></td>
                    <td>{{ $phim->ten_phim }}</td>
                    <td>{{ $phim->nam_phat_hanh }}</td>
                    <td>{{ $phim->thoi_luong }}</td>
                    <td>
                        @foreach($phim->theloais as $tl)
                            <span class="badge bg-primary">{{ $tl->ten_the_loai }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="" method="POST" class="d-inline" onsubmit="return confirm('Xóa phim này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Chưa có phim lẻ nào</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
