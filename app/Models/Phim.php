<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // [QUAN TRỌNG] Thêm dòng này để dùng DB::table
class Phim extends Model
{
    use HasFactory;

    protected $table = 'phim';

    protected $fillable = [
        'ten_phim',
        'slug',
        'mo_ta',
        'nam_phat_hanh',
        'duong_dan',
        'anh_bia',
        'loai',
        'trailer',
        'video',
        'so_tap',
        'thoi_luong',
        'trang_thai',
        'hien_thi',
    ];

    public function theloais()
    {
        return $this->belongsToMany(TheLoai::class, 'phim_the_loai', 'phim_id', 'the_loai_id');
    }
    /**
     * Mối quan hệ 1:N: Một Phim có nhiều Tập Phim.
     * Phương thức này phải được đặt tên là 'taps'.
     */
    public function taps()
    {
        return $this->hasMany(TapPhim::class, 'phim_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Sự kiện: Khi một phim vừa được tạo xong (created)
        static::created(function ($phim) {
            // Tự động chèn 1 dòng vào bảng 'views' với số view = 0
            DB::table('views')->insert([
                'phim_id' => $phim->id,
                'tong_views' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
    public function views()
    {
        // Quan hệ 1-1 với bảng views
        return $this->hasOne(Views::class, 'phim_id', 'id');
    }
}
