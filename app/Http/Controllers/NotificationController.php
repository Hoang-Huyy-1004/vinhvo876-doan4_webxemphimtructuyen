<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Danh sách thông báo của user
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('notifications.index', compact('notifications'));
    }

    // Hiển thị và đánh dấu đã đọc
    public function show($id)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($id);

        // Đánh dấu đã đọc
        if (!$notification->is_read) {
            $notification->update(['is_read' => true]);
        }

        // Bạn có thể redirect đến trang chi tiết nào đó liên quan
        return redirect()->back()->with('success', 'Đã đọc thông báo');
    }

    // Tạo thông báo mới (admin có thể gọi)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thông báo đã được gửi');
    }
}
