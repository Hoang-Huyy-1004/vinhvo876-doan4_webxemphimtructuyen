<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    use HasFactory;

    protected $table = 'views';
    
    // Khai báo các cột được phép sửa
    protected $fillable = ['phim_id', 'tong_views'];

    // Liên kết ngược về bảng Phim để lấy tên phim
    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id', 'id');
    }
}