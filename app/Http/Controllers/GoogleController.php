<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import thư viện Log

class GoogleController extends Controller
{
    // 1. Phương thức chuyển hướng đến Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Phương thức xử lý callback từ Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Nếu user đã tồn tại theo email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Random user_id 8 số
                do {
                    $user_id = (string) random_int(10000000, 99999999);
                } while (User::where('user_id', $user_id)->exists());

                $user = User::create([
                    'user_id'   => $user_id,
                    'name'      => $googleUser->getName(),
                    'email'     => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password'  => bcrypt(str()->random(16)), // không cần password thực
                    'status'    => 1,
                ]);
            } else {
                // Nếu đã có thì update google_id
                $user->update([
                    'google_id' => $googleUser->getId(),
                ]);
            }

            $user->refresh(); // Buộc tải trạng thái mới nhất từ DB trước khi kiểm tra

            // *** THÊM LOGIC KIỂM TRA TÀI KHOẢN BỊ KHÓA ***
            if ($user->status !== null && (int)$user->status === 0) {
                // Nếu bị khóa, KHÔNG cho đăng nhập và chuyển hướng về trang đăng nhập với lỗi
                return redirect()->route('dangnhap.form')->withErrors([
                    'email' => 'Tài khoản của bạn đã bị khóa.', // Thông báo lỗi
                ]);
            }

            // **********************************************

            Auth::login($user);

            return redirect('/')->with('success', 'Đăng nhập Google thành công!');
        } catch (\Exception $e) {
            // GHI LỖI CHI TIẾT VÀO LOG FILE
            Log::error("Google Login Failed: " . $e->getMessage(), ['exception' => $e]);
            
            // TẠM THỜI HIỂN THỊ LỖI CHI TIẾT TRÊN GIAO DIỆN ĐỂ DEBUG
            return redirect()->route('dangnhap.form')->withErrors([
                // Dùng $e->getMessage() để xem lỗi cụ thể
                'google' => 'Đăng nhập Google thất bại. Lỗi chi tiết: ' . $e->getMessage(), 
            ]);
        }
    }
}
