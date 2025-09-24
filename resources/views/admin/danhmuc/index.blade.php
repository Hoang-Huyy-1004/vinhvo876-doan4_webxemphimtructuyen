<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Thể Loại Phim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('admin.layouts.app')

    @section('content')
  
        <h2 class="mb-4">Quản lý Thể Loại Phim</h2>

        {{-- Hiển thị thông báo --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form thêm mới --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Thêm thể loại mới</div>
            <div class="card-body">
                <form action="{{ route('danhmuc.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_the_loai" class="form-label">Tên thể loại</label>
                        <input type="text" name="ten_the_loai" id="ten_the_loai" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>

        {{-- Danh sách danh mục --}}
        <div class="card">
            <div class="card-header bg-primary text-white">Danh sách thể loại</div>
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Tên thể loại</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($danhmucs as $dm)
                        <tr>
                            <td>{{ $dm->ten_the_loai }}</td>
                            <td>
                                {{-- Sửa --}}
                                <form action="{{ route('danhmuc.update', $dm->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="ten_the_loai" value="{{ $dm->ten_the_loai }}" class="form-control form-control-sm d-inline w-50">
                                    <button type="submit" class="btn btn-sm btn-warning">Sửa</button>
                                </form>

                                {{-- Xóa --}}
                                <form action="{{ route('danhmuc.destroy', $dm->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Nếu không có thể loại --}}
                @if($danhmucs->isEmpty())
                    <p class="text-muted">Chưa có thể loại nào.</p>
                @endif
            </div>
        </div>
    @endsection
</body>
</html>
