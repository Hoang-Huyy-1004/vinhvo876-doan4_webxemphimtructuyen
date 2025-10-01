<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapPhim extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'tap_phim';

    protected $fillable = [
        'phim_id',
        'ten_phim', // Tên phim (theo cấu trúc bảng của bạn)
        'video',
        'tap', // <--- ĐÃ ĐIỀU CHỈNH: Sử dụng tên cột 'tap'
        'trang_thai',
    ];

    /**
     * Mối quan hệ: Một tập phim thuộc về một phim (N:1)
     */
    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id');
    }
}
