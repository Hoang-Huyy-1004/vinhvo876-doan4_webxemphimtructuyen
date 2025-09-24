<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('phim', function (Blueprint $table) {
            $table->id();
            $table->string('ten_phim');
            $table->text('mo_ta')->nullable();
            $table->integer('nam_phat_hanh')->nullable();
            $table->string('duong_dan')->unique(); // slug
            $table->string('anh_bia')->nullable();
            $table->enum('loai', ['phim_le', 'phim_bo']);
            $table->string('trailer')->nullable();
            $table->string('video')->nullable(); // áp dụng cho phim lẻ
            $table->integer('thoi_luong')->nullable(); // áp dụng cho phim lẻ
            $table->enum('trang_thai', ['cong_khai', 'nhap'])->default('cong_khai');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('phim');
    }
};
