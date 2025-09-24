<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;

    protected $table = 'the_loai';   // Tên bảng trong DB
    protected $fillable = ['ten_the_loai']; // Các cột cho phép thêm/sửa
}
