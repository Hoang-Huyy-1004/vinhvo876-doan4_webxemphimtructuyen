<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Kiểm tra nếu chưa có tài khoản admin123 thì tạo mới
        $exists = DB::table('users')->where('name', 'admin123')->orWhere('email', 'admin123@gmail.com')->exists();

        if (!$exists) {
            DB::table('users')->insert([
                'user_id' => '88888888',
                'name' => 'admin123',
                'email' => 'admin123@gmail.com',
                'password' => Hash::make('admin123'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('name', 'admin123')->orWhere('email', 'admin123@gmail.com')->delete();
    }
};
