<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuView extends Model
{
    use HasFactory;

    protected $table = 'lich_su_views';

    protected $fillable = [
        'phim_id',
        'view_ngay',
        'ngay'
    ];

    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id', 'id');
    }
}