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
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ Email.',
            'email.email' => 'Địa chỉ Email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng. Vui lòng chọn Email khác hoặc đăng nhập.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        // Tạo uid 8 số ngẫu nhiên, tránh trùng
        do {
            $user_id = (string) random_int(10000000, 99999999);
        } while (User::where('user_id', $user_id)->exists());

        // Tạo name mặc định từ email (phần trước @)
        $name = strstr($request->email, '@', true) ?: 'User';

        // Lưu vào DB với trạng thái mặc định là 1 (Hoạt động)
        User::create([
            'user_id' => $user_id,
            'name' => $name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);

        return redirect()->route('dangnhap.form')
            ->with('success', 'Đăng ký tài khoản thành công! Mời bạn đăng nhập.');
    }


    // Hiển thị form đăng nhập
    public function showLogin()
    {
        return view('user.dangnhap');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $loginInput = $request->input('email');
        $password = $request->input('password');

        // Tìm người dùng theo Email hoặc Tên tài khoản (name)
        $user = User::where('email', $loginInput)->orWhere('name', $loginInput)->first();

        if ($user && Hash::check($password, $user->password)) {
            $user->refresh();

            // Kiểm tra nếu tài khoản thực sự bị khóa (status = 0)
            if ($user->status !== null && (int)$user->status === 0) {
                return redirect()->back()->withErrors([
                    'email' => 'Tài khoản của bạn đã bị khóa.',
                ]);
            }

            Auth::login($user);

            // Kiểm tra nếu là Admin (tên hoặc email có chứa 'admin', ví dụ admin123, admin123@gmail.com)
            $nameLower = strtolower(trim($user->name ?? ''));
            $emailLower = strtolower(trim($user->email ?? ''));

            if (str_contains($nameLower, 'admin') || str_contains($emailLower, 'admin')) {
                return redirect('/admin')->with('success', 'Đăng nhập Quản trị viên thành công!');
            }


            return redirect('/')->with('success', 'Đăng nhập thành công');

        }

        return redirect()->back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
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

    // Lấy tất cả người dùng từ bảng 'users'
    public function listUsers()
    {
        $users = User::all();
        return view('admin.taikhoan.ds_taikhoan', compact('users'));
    }

    public function toggleStatus($user_id)
    {
        // Tìm người dùng bằng user_id
        $user = User::where('user_id', $user_id)->firstOrFail();

        // Chuyển đổi trạng thái: 1 thành 0, 0 thành 1
        $newStatus = $user->status == 1 ? 0 : 1;
        $user->status = $newStatus;
        $user->save();

        // *** THÊM DÒNG NÀY ĐỂ BUỘC LÀM MỚI DỮ LIỆU TỪ DATABASE ***
        $user->refresh();
        // *******************************************************

        // Chuẩn bị thông báo
        $message = $newStatus == 1 ? 'Tài khoản đã được MỞ KHÓA thành công.' : 'Tài khoản đã bị KHÓA thành công.';

        // Quay về trang danh sách tài khoản
        return back()->with('success', $message);
    }
}
