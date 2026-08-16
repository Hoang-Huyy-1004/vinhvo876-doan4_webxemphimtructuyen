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

        // Fallback và xây dựng danh sách gợi ý cho từng phim nếu chưa có dữ liệu từ AI
        if (empty($watched)) {
            try {
                $allPhims = Phim::all();
                if ($allPhims->count() > 0) {
                    $watchedPhims = $allPhims->take(4);
                    foreach ($watchedPhims as $phim) {
                        $watched[] = [
                            'title' => $phim->ten_phim,
                            'id' => $phim->id,
                            'anh_bia' => $phim->anh_bia,
                            'slug' => $phim->duong_dan,
                        ];
                    }
                }
            } catch (\Exception $e) {
                $watched = [
                    ['title' => 'Cô Ba Sài Gòn', 'id' => null, 'anh_bia' => null],
                    ['title' => 'Mai', 'id' => null, 'anh_bia' => null],
                    ['title' => 'Kẻ Ăn Hồn', 'id' => null, 'anh_bia' => null],
                ];
            }
        }

        // Đảm bảo luôn có bộ gợi ý riêng biệt cho TỪNG phim đã xem
        if (empty($movieRecommendations) && !empty($watched)) {
            try {
                $allPhims = Phim::all();
                foreach ($watched as $wIndex => $wMovie) {
                    $candidates = $allPhims->where('id', '!=', $wMovie['id'] ?? 0);
                    $suggested = $candidates->shuffle()->take(3);

                    $recsForMovie = [];
                    $scores = [4.9, 4.7, 4.5];
                    $i = 0;
                    foreach ($suggested as $sPhim) {
                        $recsForMovie[] = [
                            'title' => $sPhim->ten_phim,
                            'id' => $sPhim->id,
                            'anh_bia' => $sPhim->anh_bia,
                            'score' => $scores[$i] ?? 4.5,
                        ];
                        $i++;
                    }

                    $movieRecommendations[$wMovie['title']] = $recsForMovie;
                }
            } catch (\Exception $e) {
                // Mock dữ liệu gợi ý riêng cho từng phim nếu không kết nối được DB
                foreach ($watched as $wMovie) {
                    $movieRecommendations[$wMovie['title']] = [
                        ['title' => 'Cuộc Chiến Vô Cực', 'score' => 4.9, 'id' => null, 'anh_bia' => null],
                        ['title' => 'Hành Tinh Mẹ', 'score' => 4.7, 'id' => null, 'anh_bia' => null],
                        ['title' => 'Thế Giới Vuông', 'score' => 4.5, 'id' => null, 'anh_bia' => null],
                    ];
                }
            }
        }

        // Gán gợi ý mặc định là danh sách của phim đầu tiên
        if (!empty($watched[0]['title']) && isset($movieRecommendations[$watched[0]['title']])) {
            $recommendations = $movieRecommendations[$watched[0]['title']];
        }

        // Lấy thông tin user để hiển thị tên chính xác
        $userObj = \App\Models\User::where('user_id', $userId)->orWhere('id', $userId)->first();
        $userName = $userObj->name ?? (Auth::check() ? Auth::user()->name : "Người dùng");

        return view('recommend', [
            'userId' => $userId,
            'userName' => $userName,
            'watched' => $watched,
            'recommendations' => $recommendations,
            'movieRecommendations' => $movieRecommendations,
        ]);
    }
}