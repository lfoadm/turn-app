<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function read($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);

        // Marca como lida
        $notification->markAsRead();

        // Redireciona para a rota de usuários pendentes
        return redirect()->route('users.pending', compact('users'));
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Todas as notificações foram marcadas como lidas!');
    }
}
