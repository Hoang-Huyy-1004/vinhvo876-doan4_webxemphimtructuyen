<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('phim', function (Blueprint $table) {
            $table->string('hien_thi')->default('binh_thuong')->after('trang_thai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('phim', function (Blueprint $table) {
            $table->dropColumn('hien_thi');
        });
    }
};

