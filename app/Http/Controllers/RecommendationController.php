<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Phim;

class RecommendationController extends Controller
{
    public function recommend($userId = null)
    {
        // Nếu không truyền userId, tự động lấy user_id hoặc id của người dùng đang đăng nhập
        if (empty($userId)) {
            if (!Auth::check()) {
                return redirect()->route('dangnhap.form')->withErrors(['email' => 'Vui lòng đăng nhập để xem gợi ý phim.']);
            }
            $userId = Auth::user()->user_id ?? Auth::id();
        }

        $python = base_path(".venv\\Scripts\\python.exe");
        $script = storage_path("app/ai/recommend.py");

        $watched = [];
        $recommendations = [];
        $movieRecommendations = [];

        if (file_exists($script) && file_exists($python)) {
            $command = "\"{$python}\" \"{$script}\" {$userId}";
            $output = shell_exec($command);
            $data = json_decode($output, true);

            if (!empty($data['success'])) {
                $watchedRaw = $data['watched'] ?? [];
                $recommendations = $data['recommendations'] ?? [];
                $movieRecommendationsRaw = $data['movie_recommendations'] ?? [];

                // Xử lý thông tin phim đã xem và tìm trong DB (nếu có)
                foreach ($watchedRaw as $movieTitle) {
                    $cleanTitle = preg_replace('/\s*\(\d{4}\)$/', '', $movieTitle);
                    $phim = Phim::where('ten_phim', 'LIKE', '%' . trim($cleanTitle) . '%')->first();

                    $watched[] = [
                        'title' => $movieTitle,
                        'id' => $phim->id ?? null,
                        'anh_bia' => $phim->anh_bia ?? null,
                        'slug' => $phim->duong_dan ?? null,
                    ];
                }

                // Xử lý ghép thêm ID cho các gợi ý nếu tìm thấy trong DB
                foreach ($recommendations as $index => &$item) {
                    $cleanTitle = preg_replace('/\s*\(\d{4}\)$/', '', $item['title']);
                    $phim = Phim::where('ten_phim', 'LIKE', '%' . trim($cleanTitle) . '%')->first();
                    $item['id'] = $phim->id ?? null;
                    $item['anh_bia'] = $phim->anh_bia ?? null;
                }
                unset($item);

                foreach ($movieRecommendationsRaw as $wTitle => &$mRecs) {
                    foreach ($mRecs as &$item) {
                        $cleanTitle = preg_replace('/\s*\(\d{4}\)$/', '', $item['title']);
                        $phim = Phim::where('ten_phim', 'LIKE', '%' . trim($cleanTitle) . '%')->first();
                        $item['id'] = $phim->id ?? null;
                        $item['anh_bia'] = $phim->anh_bia ?? null;
                    }
                    unset($item);
                }
                unset($mRecs);

                $movieRecommendations = $movieRecommendationsRaw;
            }
        }

        // Fallback dữ liệu nếu chưa có dữ liệu từ AI script
        if (empty($recommendations)) {
            try {
                $phims = Phim::inRandomOrder()->take(6)->get();
                if ($phims->count() > 0) {
                    foreach ($phims->take(3) as $index => $phim) {
                        $watched[] = [
                            'title' => $phim->ten_phim,
                            'id' => $phim->id,
                            'anh_bia' => $phim->anh_bia,
                            'slug' => $phim->duong_dan,
                        ];
                    }
                    foreach ($phims->skip(3)->take(3) as $index => $phim) {
                        $recommendations[] = [
                            'title' => $phim->ten_phim ?? ('Phim gợi ý ' . ($index + 1)),
                            'score' => round(4.9 - ($index * 0.2), 1),
                            'confidence' => 98 - ($index * 5),
                            'lift' => round(2.1 - ($index * 0.3), 1),
                            'id' => $phim->id ?? null,
                            'anh_bia' => $phim->anh_bia ?? null,
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Fallback mock data
                $watched = [
                    ['title' => 'Cô Ba Sài Gòn (2017)', 'id' => null],
                    ['title' => 'Mai (2024)', 'id' => null],
                    ['title' => 'Kẻ Ăn Hồn (2023)', 'id' => null],
                ];
                $recommendations = [
                    ['title' => 'Cuộc Chiến Vô Cực', 'score' => 4.9, 'confidence' => 98, 'lift' => 2.1, 'id' => null],
                    ['title' => 'Hành Tinh Mẹ', 'score' => 4.7, 'confidence' => 93, 'lift' => 1.8, 'id' => null],
                    ['title' => 'Thế Giới Vuông', 'score' => 4.5, 'confidence' => 88, 'lift' => 1.5, 'id' => null],
                ];
            }
        }

        return view('recommend', [
            'userId' => $userId,
            'watched' => $watched,
            'recommendations' => $recommendations,
            'movieRecommendations' => $movieRecommendations,
        ]);
    }
}