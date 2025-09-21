<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;


class VideoController extends Controller
{
    public function search(Request $request)
{
    $query = Video::query();

    // Tìm kiếm theo từ khóa
    if ($request->filled('q')) {
        $query->where('title', 'LIKE', '%' . $request->q . '%');
    }

    // Lọc theo chữ cái
    if ($request->filled('letter')) {
        $query->where('title', 'LIKE', $request->letter . '%');
    }

    $videos = $query->paginate(12);

    return view('search', compact('videos'));
}

}
