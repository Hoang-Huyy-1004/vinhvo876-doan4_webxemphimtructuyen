<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Phim;
use App\Models\LuotXem;

class RecommendationController extends Controller
{
    public function recommend($userId = null)
    {
        // 1. Nếu không truyền userId, tự động lấy ID của người dùng đang đăng nhập
        if (empty($userId)) {
            if (!Auth::check()) {
                return redirect()->route('dangnhap.form')->withErrors(['email' => 'Vui lòng đăng nhập để xem gợi ý phim.']);
            }
            $userId = Auth::user()->user_id ?? Auth::id();
        }

        $authUserId = Auth::id();
        $watched = [];
        $recommendations = [];
        $movieRecommendations = [];

        // 2. LẤY DỮ LIỆU XEM THỰC TẾ CỦA USER TỪ DATABASE (bảng luot_xem)
        $realUserWatched = LuotXem::where('user_id', $authUserId)
            ->orWhere('user_id', $userId)
            ->with(['phim.theloais'])
            ->latest('xem_luc')
            ->get();

        if ($realUserWatched->isNotEmpty()) {
            foreach ($realUserWatched as $log) {
                if ($log->phim) {
                    $alreadyAdded = collect($watched)->contains('id', $log->phim->id);
                    if (!$alreadyAdded) {
                        $watched[] = [
                            'title' => $log->phim->ten_phim,
                            'id' => $log->phim->id,
                            'anh_bia' => $log->phim->anh_bia,
                            'slug' => $log->phim->duong_dan,
                        ];
                    }
                }
            }
        }

        // 3. NẾU USER CHƯA CÓ LỊCH SỬ XEM TRONG DB, THỬ CHẠY MÔ HÌNH PYTHON AI RECOMMEND
        if (empty($watched)) {
            $python = base_path(".venv\\Scripts\\python.exe");
            $script = storage_path("app/ai/recommend.py");

            if (file_exists($script) && file_exists($python)) {
                $command = "\"{$python}\" \"{$script}\" {$userId}";
                $output = shell_exec($command);
                $data = json_decode($output, true);

                if (!empty($data['success'])) {
                    $watchedRaw = $data['watched'] ?? [];
                    $recommendations = $data['recommendations'] ?? [];
                    $movieRecommendationsRaw = $data['movie_recommendations'] ?? [];

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
        }

        // 4. MẪU DỰ PHÒNG CỦA HỆ THỐNG: Nếu user hoàn toàn chưa xem phim nào trong DB lẫn AI
        if (empty($watched)) {
            try {
                $allPhims = Phim::inRandomOrder()->take(4)->get();
                foreach ($allPhims as $phim) {
                    $watched[] = [
                        'title' => $phim->ten_phim,
                        'id' => $phim->id,
                        'anh_bia' => $phim->anh_bia,
                        'slug' => $phim->duong_dan,
                    ];
                }
            } catch (\Exception $e) {
                $watched = [
                    ['title' => 'Doraemon', 'id' => null, 'anh_bia' => null],
                ];
            }
        }

        // 5. THUẬT TOÁN GỢI Ý PHIM DỰA TRÊN THỂ LOẠI CHO TỪNG PHIM ĐÃ XEM THỰC TẾ
        if (empty($movieRecommendations) && !empty($watched)) {
            $watchedIds = collect($watched)->pluck('id')->filter()->toArray();

            foreach ($watched as $wMovie) {
                $recsForMovie = [];

                if (!empty($wMovie['id'])) {
                    $currentPhim = Phim::with('theloais')->find($wMovie['id']);

                    if ($currentPhim && $currentPhim->theloais->isNotEmpty()) {
                        $catIds = $currentPhim->theloais->pluck('id');

                        // Lấy các phim cùng thể loại nhưng chưa xem
                        $suggested = Phim::whereHas('theloais', function ($q) use ($catIds) {
                            $q->whereIn('the_loai.id', $catIds);
                        })
                        ->where('id', '!=', $wMovie['id'])
                        ->whereNotIn('id', $watchedIds)
                        ->inRandomOrder()
                        ->take(3)
                        ->get();

                        // Nếu cùng thể loại không đủ 3 phim, bù thêm các phim ngẫu nhiên khác
                        if ($suggested->count() < 3) {
                            $excludeIds = array_merge([$wMovie['id']], $watchedIds, $suggested->pluck('id')->toArray());
                            $more = Phim::whereNotIn('id', $excludeIds)->inRandomOrder()->take(3 - $suggested->count())->get();
                            $suggested = $suggested->merge($more);
                        }

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
                    }
                }

                // Nếu phim không có ID hoặc chưa tìm được gợi ý, dùng gợi ý ngẫu nhiên
                if (empty($recsForMovie)) {
                    $randomPhims = Phim::where('id', '!=', $wMovie['id'] ?? 0)->inRandomOrder()->take(3)->get();
                    $scores = [4.9, 4.7, 4.5];
                    $i = 0;
                    foreach ($randomPhims as $rPhim) {
                        $recsForMovie[] = [
                            'title' => $rPhim->ten_phim,
                            'id' => $rPhim->id,
                            'anh_bia' => $rPhim->anh_bia,
                            'score' => $scores[$i] ?? 4.5,
                        ];
                        $i++;
                    }
                }

                $movieRecommendations[$wMovie['title']] = $recsForMovie;
            }
        }

        // 6. Gán gợi ý mặc định là danh sách gợi ý của phim đầu tiên
        if (!empty($watched[0]['title']) && isset($movieRecommendations[$watched[0]['title']])) {
            $recommendations = $movieRecommendations[$watched[0]['title']];
        }

        // 7. Lấy thông tin hiển thị tên người dùng
        $userObj = \App\Models\User::where('id', $authUserId)->orWhere('user_id', $userId)->first();
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