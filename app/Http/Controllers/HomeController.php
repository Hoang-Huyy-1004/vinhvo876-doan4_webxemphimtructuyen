<?php

namespace App\Http\Controllers;

use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy danh sách phim mới nhất
        $videos = Video::latest()->take(10)->get();

        return view('home', compact('videos'));
    }
}

