<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tap_phim', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phim_id')->constrained('phim')->onDelete('cascade');
            $table->string('ten_phim');
            $table->string('video');
            $table->integer('so_tap');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tap_phim');
    }
};
