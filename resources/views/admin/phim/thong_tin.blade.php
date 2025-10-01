@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4 text-primary">Thông tin chi tiết phim: {{ $phim->ten_phim }} </h2>
        <hr>
    </div>
</div>

<div class="row">
    {{-- Cột ảnh bìa --}}
    <div class="col-md-4 ">
        <div class="card shadow mb-4">
            <div class="card-header bg-dark text-white">Ảnh bìa</div>
            <div class="card-body p-2 text-center">
                @if($phim->anh_bia)
                <img src="{{ asset($phim->anh_bia) }}"
                    alt="{{ $phim->ten_phim }}"
                    class="img-fluid rounded shadow"
                    style="max-height: 400px; object-fit: cover;">
                @else
                <div class="alert alert-secondary">Không có ảnh bìa.</div>
                @endif
            </div>
        </div>

        {{-- Nút quay lại/sửa --}}
        <div class="d-grid gap-2 mb-4">
            {{-- Quay lại trang trước (danh sách phim bộ/lẻ) --}}
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
            <a href="{{ route('phim.edit', $phim->id) }}" class="btn btn-warning btn-block">
                <i class="fas fa-edit"></i> Chỉnh sửa phim
            </a>
        </div>
    </div>

    {{-- Cột thông tin chi tiết --}}
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header bg-dark text-white">Chi tiết</div>
            <div class="card-body">

                <h5 class="card-title text-success mb-3">{{ $phim->ten_phim }} ({{ $phim->nam_phat_hanh }})</h5>

                <table class="table table-sm table-borderless">
                    <tr>
                        <td style="width: 150px;"><strong>Loại:</strong></td>
                        <td>
                            @if($phim->loai === 'phim_bo')
                            <span class="badge bg-primary text-white">Phim Bộ</span>
                            @else
                            <span class="badge bg-info text-white">Phim Lẻ</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Thể loại:</strong></td>
                        <td>
                            @foreach($phim->theloais as $tl)
                            <span class="badge bg-dark text-white">{{ $tl->ten_the_loai }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Thời lượng:</strong></td>
                        <td>{{ $phim->thoi_luong ?? 'Chưa rõ' }} phút</td>
                    </tr>
                    @if($phim->loai === 'phim_bo')
                    <tr>
                        <td><strong>Tổng số tập:</strong></td>
                        <td>{{ $phim->so_tap ?? 'Đang cập nhật' }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Trạng thái:</strong></td>
                        <td>
                            @if($phim->trang_thai === 'cong_khai')
                            <span class="badge bg-success text-white">Công khai</span>
                            @else
                            <span class="badge bg-danger text-white">Nháp</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Hiển thị:</strong></td>
                        <td>
                            <span class="badge bg-warning text-white">{{ ucfirst(str_replace('_', ' ', $phim->hien_thi)) }}</span>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Ngày đăng: </strong></td>
                        <td> {{ $phim->created_at->format('d/m/Y') }} </td>
                    </tr>

                    <tr>
                        <td> <strong>Mô tả: </strong></td>
                        <td>
                            <span> {{ $phim->mo_ta }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td> <strong> Trailer:</strong></td>
                        <td>
                            <strong> @if($phim->trailer) <a href="{{ asset($phim->trailer) }}" target="_blank" class="btn btn-outline-danger btn-sm">Xem Trailer</a>
                                @else
                                <span class="text-muted small">Không có trailer</span>
                                @endif </strong>
                        </td>
                    </tr>
                </table>

                <!-- @if($phim->loai === 'phim_le' && $phim->video)
                <h6 class="mt-4 text-muted">Video chính:</h6>
                <a href="{{ asset($phim->video) }}" target="_blank" class="btn btn-outline-success btn-sm">Xem Video</a>
                @endif -->

            </div>
        </div>
    </div>
</div>
<div>
    {{-- Bảng này sẽ hiển thị danh sách các tập phim --}}
    <h4 class="mt-4 text-primary">Danh sách tập phim</h4>
    <table class="table table-bordered">
        <thead>
            <tr class="bg-primary text-white">
                <th style="width: 4%;">Tập</th>
                <th style="width: 40%;">Tên tập (Mô tả)</th>
                <th style="width: 34%;">Video</th>
                <th style="width: 10%;">Trạng thái</th>
                <th style="width: 10%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            {{-- Bảng hiển thị tập phim --}}
            @if($phim->loai === 'phim_bo')
            {{-- CASE 1: PHIM BỘ (LẶP QUA CÁC TẬP) --}}
            @forelse($phim->taps as $tap)
            <tr>
                <td class="text-center">{{ $tap->tap }}</td>
                <td>{{ $tap->ten_phim }} - Tập {{ $tap->tap }}</td>
                <td>
                    @if($tap->video)
                    <a href="{{ asset($tap->video) }}" target="_blank" class="btn btn-sm btn-outline-success">Xem Video</a>
                    @else
                    <span class="text-muted small">Chưa có video</span>
                    @endif
                </td>
                <td>
                    @if($tap->trang_thai === 'cong_khai')
                    <span class="badge bg-success text-white">Công khai</span>
                    @else
                    <span class="badge bg-danger text-white">Nháp</span>
                    @endif
                </td>
                <td>
                    {{-- Nút sửa tập phim. Cần tạo route cho TapPhimController --}}
                    <a href="{{ route('phim.tapphim.edit', ['phim' => $phim->id, 'tapPhim' => $tap->id]) }}"
                        class="btn btn-info btn-sm" title="Sửa tập phim">Sửa
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Phim bộ này chưa có tập nào được tạo.</td>
            </tr>
            @endforelse

            @else
            {{-- CASE 2: PHIM LẺ (DÙNG THÔNG TIN BẢNG PHIM CHÍNH) --}}
            <tr>
                <td class="text-center">1</td> {{-- Phim lẻ chỉ có 1 tập --}}
                <td>{{ $phim->ten_phim }}</td> {{-- Lấy tên phim --}}
                <td>
                    @if($phim->video)
                    <a href="{{ asset($phim->video) }}" target="_blank" class="btn btn-sm btn-outline-success">Xem Video</a>
                    @else
                    <span class="text-muted small">Chưa có video</span>
                    @endif
                </td>
                <td>
                    @if($phim->trang_thai === 'cong_khai')
                    <span class="badge bg-success text-white">Công khai</span>
                    @else
                    <span class="badge bg-danger text-white">Nháp</span>
                    @endif
                </td>
                <td>
                    {{-- Nút sửa phim. Dẫn về trang sửa phim chính. --}}
                    <a href="{{ route('phim.edit', $phim->id) }}" class="btn btn-warning btn-sm" title="Sửa video phim lẻ">Sửa</a>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection