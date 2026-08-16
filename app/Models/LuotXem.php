<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuotXem extends Model
{
    use HasFactory;

    protected $table = 'luot_xem';

    protected $fillable = [
        'user_id',
        'phim_id',
        'tap_phim_id',
        'xem_luc',
    ];

    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
