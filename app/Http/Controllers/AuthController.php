<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegister()
    {
        return view('user.dangky');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Tạo uid 8 số ngẫu nhiên, tránh trùng
        do {
            $uid = (string) random_int(10000000, 99999999);
        } while (User::where('uid', $uid)->exists());

        // Tạo name mặc định từ email (phần trước @)
        $name = strstr($request->email, '@', true);

        // Lưu vào DB
        User::create([
            'uid' => $uid,
            'name' => $name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dangnhap.form')
            ->with('success', 'Đăng ký thành công! Mời bạn đăng nhập.');
    }

    // Hiển thị form đăng nhập
    public function showLogin()
    {
        return view('user.dangnhap');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Đăng nhập thành công');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ]);
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Bạn đã đăng xuất thành công!');
    }

    // lấy thông tin
    public function profile()
    {
        $user = Auth::user();
        return view('user.taikhoan', compact('user'));
    }
}
