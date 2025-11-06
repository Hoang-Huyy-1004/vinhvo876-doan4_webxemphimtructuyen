<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Phim;
use App\Models\TheLoai;
use App\Models\TapPhim;

class CrawlPhimOphim extends Command
{
    // Tên lệnh chạy trong terminal
    protected $signature = 'phim:update-ophim';

    // Mô tả lệnh
    protected $description = 'Cập nhật dữ liệu phim từ https://ophim1.com/';

    public function handle()
    {
        $this->info(' Đang crawl dữ liệu phim từ ophim1.com ...');

        //  Dùng domain mới hoạt động
        $url = 'https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1';

        $response = Http::withoutVerifying()->get($url);

        if (!$response->ok()) {
            $this->error(' Không thể lấy dữ liệu từ ophim1.com');
            return;
        }

        $data = $response->json();
        $phimList = $data['items'] ?? [];

        if (empty($phimList)) {
            $this->warn(' Không có dữ liệu phim nào được trả về!');
            return;
        }

        foreach ($phimList as $phimData) {
            $this->savePhim($phimData);
        }

        $this->info(' Hoàn tất cập nhật!');
    }

    //  HÀM LƯU PHIM
    protected function savePhim($phimData)
    {
        $slug = $phimData['slug'] ?? null;
        if (!$slug) return;

        $phim = Phim::where('slug', $slug)->first();

        $tenPhim = $phimData['name'] ?? 'Không rõ';
        $moTa = $phimData['content'] ?? '';
        $nam = $phimData['year'] ?? null;
        $poster = $phimData['poster_url'] ?? '';
if ($poster) {
    // Nếu không có http thì thêm prefix domain gốc
    if (!str_starts_with($poster, 'http')) {
        $poster = 'https://img.ophim.live' . $poster;
    }
    // Chuyển về dạng CDN Ophim18
    $encodedUrl = urlencode($poster);
    $poster = "https://ophim18.cc/_next/image?url={$encodedUrl}&w=1920&q=75";
}
$anhBia = $poster;


        $trailer = $phimData['trailer_url'] ?? null;
        $type = $phimData['type'] ?? 'single';
        $loai = ($type === 'single') ? 'phim_le' : 'phim_bo';
        $trangThai = 'cong_khai';

        if (!$phim) {
            $phim = Phim::create([
                'slug' => $slug,
                'ten_phim' => $tenPhim,
                'mo_ta' => $moTa,
                'nam_phat_hanh' => $nam,
                'anh_bia' => $anhBia,
                'loai' => $loai,
                'trailer' => $trailer,
                'trang_thai' => $trangThai,
                'cap_nhat_luc' => now(),
            ]);
            $this->info("🆕 Thêm mới: {$tenPhim}");
        } else {
            $phim->update([
                'mo_ta' => $moTa,
                'anh_bia' => $anhBia,
                'trang_thai' => $trangThai,
                'cap_nhat_luc' => now(),
            ]);
            $this->comment("🔁 Cập nhật: {$tenPhim}");
        }

        // Lưu thể loại
        if (!empty($phimData['category'])) {
            foreach ($phimData['category'] as $cat) {
                $theLoai = TheLoai::firstOrCreate([
                    'ten_the_loai' => $cat['name']
                ]);

                // Gắn thể loại cho phim (bảng trung gian)
                $phim->theloais()->syncWithoutDetaching([$theLoai->id]);
            }
        }

        // Lưu tập phim
        $this->saveTapPhim($slug, $phim);
    }

    // 🧩 HÀM LƯU TẬP PHIM
    protected function saveTapPhim($slug, $phim)
    {
        $apiUrl = "https://ophim1.com/phim/{$slug}";
        $response = Http::withoutVerifying()->get($apiUrl);

        if (!$response->ok()) {
            $this->warn("⚠️ Không thể lấy tập phim cho: {$slug}");
            return;
        }

        $json = $response->json();
        $episodes = $json['episodes'][0]['server_data'] ?? [];

        if (empty($episodes)) {
            $this->warn("⚠️ Phim {$phim->ten_phim} chưa có tập nào.");
            return;
        }

        foreach ($episodes as $ep) {
            $tapSo = trim($ep['name'] ?? '');
            $linkVideo = trim($ep['link_embed'] ?? '');

            // Nếu thiếu dữ liệu thì bỏ qua tập đó
            if ($tapSo === '' || $linkVideo === '') {
                $this->warn("⚠️ Bỏ qua tập lỗi của phim {$phim->ten_phim}");
                continue;
            }

            TapPhim::updateOrCreate(
                [
                    'phim_id' => $phim->id,
                    'tap' => (int) $tapSo, // ép kiểu int
                ],
                [
                    'video' => $linkVideo,
                    'trang_thai' => 'cong_khai',
                ]
            );
        }

        $this->line("✅ Đã lưu " . count($episodes) . " tập cho phim: {$phim->ten_phim}");
    }
}
