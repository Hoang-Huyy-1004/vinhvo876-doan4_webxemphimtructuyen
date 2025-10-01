<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Nếu user bị khóa và không phải admin
            if ($user->status == 0 && $user->role !== 'admin') {
                Auth::logout();

                // Nếu request từ trang user thì đưa về dangnhap
                if ($request->is('user/*') || $request->is('dangnhap') || $request->is('/')) {
                    return redirect()->route('dangnhap')->withErrors([
                        'email' => 'Tài khoản của bạn đã bị khóa.',
                    ]);
                }

                // Còn nếu từ trang admin thì giữ nguyên admin
                return redirect()->back()->withErrors([
                    'email' => 'Tài khoản người dùng đã bị khóa.',
                ]);
            }
        }

        return $next($request);
    }
}

