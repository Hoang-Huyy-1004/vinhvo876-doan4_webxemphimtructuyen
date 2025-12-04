<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\User;
use App\Models\Views;
use App\Models\LichSuView; 
use App\Models\TapPhim; 
use App\Models\BinhLuan; 
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // --- PHẦN 1: THỐNG KÊ SỐ LIỆU (Giữ nguyên của bạn) ---
        $tongPhim = Phim::count();
        $tongUser = User::count();
        $viewPhimLe = Views::sum('tong_views');
        $tongLuotXem = $viewPhimLe;


        // --- PHẦN 2: XỬ LÝ BIỂU ĐỒ (Lấy từ hàm showChart bỏ sang đây) ---
        
        // Lấy tháng năm hiện tại
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $daysInMonth = Carbon::now()->daysInMonth;

        // Lấy dữ liệu view
        $viewsData = LichSuView::whereMonth('ngay', $month)
            ->whereYear('ngay', $year)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->ngay)->format('j');
            });

        $labels = []; 
        $dataViews = []; 

        // Vòng lặp tạo dữ liệu đầy đủ cho các ngày trong tháng
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $labels[] = "Ngày " . $day;

            if (isset($viewsData[$day])) {
                $totalView = $viewsData[$day]->sum('view_ngay');
                $dataViews[] = $totalView;
            } else {
                $dataViews[] = 0;
            }
        }

        // --- PHẦN 3: TRẢ VỀ VIEW VỚI TẤT CẢ DỮ LIỆU ---
        // Lưu ý: Phải có đủ labels và dataViews thì view mới không lỗi
        return view('admin.dashboard', compact('tongPhim', 'tongUser', 'tongLuotXem', 'labels', 'dataViews'));
    }
}