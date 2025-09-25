<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        // Transforma em array pronto para o front
        $usersJson = $users->map(fn($h) => [
            'id'        => $h->id,
            'firstname'     => $h->firstname,
            'lastname'      => $h->lastname,
            'phone'         => $h->phone,
            'email'         => $h->email,
            'role'          => $h->roles->first()?->name,
        ]);

        // dd($usersJson);


        return view('pages.users.index', [
            'users'     => $users,
            'usersJson' => $usersJson,
        ]);
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
        // $usersPending = User::all();
        // return view('pages.users.pending', compact( 'usersPending'));

        $users = User::latest()->get();

        // Transforma em array pronto para o front
        $usersJson = $users->map(fn($h) => [
            'id'        => $h->id,
            'firstname'     => $h->firstname,
            'lastname'      => $h->lastname,
            'phone'         => $h->phone,
            'email'         => $h->email,
            'role'          =>$h->roles->name,
        ]);

        return view('pages.users.pending', [
            'users'     => $users,
            'usersJson' => $usersJson,
        ]);
    }
}
