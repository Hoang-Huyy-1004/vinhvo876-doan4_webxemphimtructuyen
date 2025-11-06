<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Phim;
use App\Models\TheLoai;

class CrawlPhimCompeting extends Command
{
    protected $signature = 'phim:update-competing';
    protected $description = 'Cập nhật phim lẻ từ https://competinghypotheses.org/danh-sach/phim-le';

    public function handle()
    {
        $this->info('🔎 Đang crawl dữ liệu phim lẻ từ competinghypotheses.org ...');

        $url = 'https://competinghypotheses.org/danh-sach/phim-le';
        $response = Http::withoutVerifying()->get($url);

        if (!$response->ok()) {
            $this->error('❌ Không thể lấy dữ liệu từ competinghypotheses.org');
            return;
        }

        $crawler = new Crawler($response->body());
        $films = $crawler->filter('a[href*="/phim/"]');

        if ($films->count() == 0) {
            $this->warn('⚠️ Không tìm thấy phim nào trong danh sách.');
            return;
        }

        $count = 0;
        $films->each(function ($node) use (&$count) {
            $link = $node->attr('href');
            if (!$link || !str_contains($link, '/phim/')) return;

            $slug = basename($link);

            // ✅ Lấy ảnh ngay từ danh sách
            $imgNode = $node->filter('img');
            $anhBia = $imgNode->count() ? $imgNode->attr('src') : null;

            // Gọi hàm crawl chi tiết (có truyền thêm $anhBia)
            $this->crawlChiTietPhim($slug, $anhBia);
            $count++;
        });

        $this->info("✅ Hoàn tất crawl $count phim lẻ từ competinghypotheses.org");
    }

    // 🧩 Crawl chi tiết từng phim
    protected function crawlChiTietPhim($slug, $anhBia = null)
    {
        $url = "https://competinghypotheses.org/phim/{$slug}";
        $response = Http::withoutVerifying()->get($url);

        if (!$response->ok()) {
            $this->warn("⚠️ Không thể tải trang phim: $slug");
            return;
        }

        $crawler = new Crawler($response->body());

        // Tên phim
        $tenPhim = $crawler->filter('h1')->count()
            ? trim($crawler->filter('h1')->text())
            : 'Không rõ';

        // Mô tả
        $moTa = $crawler->filter('.film-description, .content')->count()
            ? trim($crawler->filter('.film-description, .content')->text())
            : '';

        // Nếu chưa có ảnh bìa thì fallback lại ảnh trong trang chi tiết
        if (empty($anhBia) && $crawler->filter('img')->count()) {
            $img = $crawler->filter('img')->first()->attr('src');
            $anhBia = str_starts_with($img, 'http')
                ? $img
                : 'https://cdn.competinghypotheses.org' . $img;
        }

        // Năm phát hành
        $nam = null;
        $yearNode = $crawler->filter('.info span:contains("Năm")');
        if ($yearNode->count()) {
            $nam = trim(str_replace('Năm:', '', $yearNode->text()));
        }

        // Lưu hoặc cập nhật
        $phim = Phim::updateOrCreate(
            ['slug' => $slug],
            [
                'ten_phim' => $tenPhim,
                'mo_ta' => $moTa,
                'anh_bia' => $anhBia,
                'nam_phat_hanh' => $nam,
                'loai' => 'phim_le',
                'trang_thai' => 'cong_khai',
                'cap_nhat_luc' => now(),
            ]
        );

        $this->line("🎬 Đã lưu phim: {$tenPhim}");
    }
}
