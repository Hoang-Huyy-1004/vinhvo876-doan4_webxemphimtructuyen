<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lich_su_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phim_id')->constrained('phim')->onDelete('cascade');
            $table->integer('view_ngay')->default(0);
            $table->date('ngay');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('lich_su_views');
    }
};
