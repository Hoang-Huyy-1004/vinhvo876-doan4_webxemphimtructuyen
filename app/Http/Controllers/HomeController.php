<?php

namespace App\Http\Controllers;

use App\Models\Phim;

class HomeController extends Controller
{
   

    public function index()
    {
        $phimMoi = Phim::where('hien_thi', 'moi')
            ->where('trang_thai', 'cong_khai')
            ->latest()
            ->take(10)
            ->get();

        $phimNoiBat = Phim::where('hien_thi', 'noi_bat')
            ->where('trang_thai', 'cong_khai')
            ->latest()
            ->take(10)
            ->get();

        $phimHot = Phim::where('hien_thi', 'hot')
            ->where('trang_thai', 'cong_khai')
            ->latest()
            ->take(10)
            ->get();

        return view('home', compact('phimMoi', 'phimNoiBat', 'phimHot'));
    }
}
