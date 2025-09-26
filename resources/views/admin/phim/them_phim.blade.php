@extends('admin.layouts.app')

@section('content')
<h2 class="mb-4">Thêm phim mới</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $err)
        <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('phim.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Tên phim</label>
        <input type="text" name="ten_phim" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="mo_ta" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Năm phát hành</label>
        <input type="number" name="nam_phat_hanh" class="form-control">
    </div>

    <!-- <div class="mb-3">
        <label class="form-label">Đường dẫn (slug)</label>
        <input type="text" name="duong_dan" id="duong_dan" class="form-control" readonly>
        <small class="text-muted">Đường dẫn sẽ được tự động tạo theo tên phim</small>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tenPhimInput = document.querySelector("input[name='ten_phim']");
            const slugInput = document.getElementById("duong_dan");

            tenPhimInput.addEventListener("input", function() {
                let slug = tenPhimInput.value
                    .toLowerCase()
                    .replace(/ /g, "-") 
                    .replace(/[^\w-]+/g, ""); 
                slugInput.value = slug;
            });
        });
    </script> -->


    <div class="mb-3">
        <label class="form-label">Ảnh bìa</label>
        <input type="file" name="anh_bia" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
        <label class="form-label">Loại phim</label>
        <select name="loai" class="form-select" required>
            <option value="le">Phim lẻ</option>
            <option value="bo">Phim bộ</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Thể loại phim</label>
        <div class="row">
            @foreach($theloais as $tl)
            <div class="col-md-3 col-sm-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="theloai[]" value="{{ $tl->id }}" id="theloai{{ $tl->id }}">
                    <label class="form-check-label" for="theloai{{ $tl->id }}">
                        {{ $tl->ten_the_loai }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Trailer</label>
        <input type="file" name="trailer" class="form-control" accept="video/*">
    </div>

    <div class="mb-3">
        <label class="form-label">Video</label>
        <input type="file" name="video" class="form-control" accept="video/*">
    </div>


    <div class="mb-3">
        <label class="form-label">Thời lượng</label>
        <input type="text" name="thoi_luong" class="form-control" placeholder="VD: 120 phút">
    </div>

    <div class="mb-3">
        <label class="form-label">Trạng thái</label>
        <select name="trang_thai" class="form-select">
            <option value="cong_khai">Công khai</option>
            <option value="nhap">Nháp</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="hien_thi" class="form-label">Hiển thị</label>
        <select name="hien_thi" id="hien_thi" class="form-select">
            <option value="binh_thuong">Bình thường</option>
            <option value="noi_bat">Nổi bật</option>
            <option value="moi">Phim mới</option>
            <option value="hot">Phim hot</option>
        </select>
    </div>


    <button type="submit" class="btn btn-primary">Lưu phim</button>
</form>
@endsection