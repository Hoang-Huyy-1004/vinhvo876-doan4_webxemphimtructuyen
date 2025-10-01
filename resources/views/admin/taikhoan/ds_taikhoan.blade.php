@extends('admin.layouts.app')

@section('title', 'Quản lý Tài khoản')

@section('content')
<h1>Danh sách Tài khoản Người dùng</h1>

<table class="table table-bordered">
    <thead>
        <tr class="bg-primary text-white">
            <th>UID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->user_id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->format('d/m/Y | H:i') }}</td>
            <td>
                <a href="#" class="btn btn-sm btn-info">Hoạt động</a>
                {{-- Thêm nút xóa nếu cần --}}
            </td>
        </tr>
        @endforeach
        @if ($users->isEmpty())
        <tr>
            <td colspan="5" class="text-center">Không có tài khoản nào được tìm thấy.</td>
        </tr>
        @endif
    </tbody>
</table>

@endsection