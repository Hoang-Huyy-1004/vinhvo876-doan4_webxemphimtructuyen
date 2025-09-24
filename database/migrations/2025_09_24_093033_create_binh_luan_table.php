<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('binh_luan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('phim_id')->nullable()->constrained('phim')->onDelete('cascade');
            $table->foreignId('tap_phim_id')->nullable()->constrained('tap_phim')->onDelete('cascade');
            $table->text('noi_dung');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('binh_luan');
    }
};
