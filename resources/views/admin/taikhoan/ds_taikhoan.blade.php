@extends('admin.layouts.app')

@section('title', 'Quản lý Tài khoản')

@section('content')
<h1>Danh sách Tài khoản Người dùng</h1>

<table class="table table-bordered">
    <thead>
        <tr class="bg-primary text-white text-center">
            <th style="width: 5%;">UID</th>
            <th style="width: 30%;">Tên</th>
            <th style="width: 30%;">Email</th>
            <th style="width: 20%;">Ngày tạo</th>
            <th style="width: 15%;">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr class="text-center">
            <td>{{ $user->user_id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
            <td>
                {{-- Hiển thị trạng thái hiện tại --}}
                @if ($user->status == 1)
                <span class="badge bg-success text-white">Hoạt động</span>
                {{-- Nút chuyển trạng thái thành "Đã khóa" --}}
                <form action="{{ route('admin.taikhoan.toggle_status', $user->user_id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-warning" title="Khóa tài khoản">
                        Khóa
                    </button>
                </form>
                @else
                <span class="badge bg-danger">Đã khóa</span>
                {{-- Nút chuyển trạng thái thành "Hoạt động" --}}
                <form action="{{ route('admin.taikhoan.toggle_status', $user->user_id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-success" title="Mở khóa tài khoản">
                        Mở khóa
                    </button>
                </form>
                @endif
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