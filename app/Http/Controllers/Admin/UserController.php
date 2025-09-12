<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;
    
    public function __construct()
    {
        $this->authorize('viewAny', User::class);
    }
    
    public function index()
    {
        $usersPending = User::where('role', 'new')->get();
        $users = User::where('role', '!=', 'new')->paginate();
        return view('pages.users.index', compact('users', 'usersPending'));
    }

    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,manager,user',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário aprovado com sucesso.');
    }

    public function approvationUser()
    {
        $usersPending = User::where('role', 'new')->get();
        return view('pages.users.pending', compact( 'usersPending'));
    }
}
