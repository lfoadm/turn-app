<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ACL\Role;
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
        $roles = Role::all();
        $userRoleId = $user->roles()->pluck('id')->first(); // pega o primeiro id da role associada

        return view('pages.users.edit', compact('user', 'roles', 'userRoleId'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,id',
        ]);

        // Atualiza a relação many-to-many na tabela pivot role_user
        $user->roles()->sync([$request->role]);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function approvationUser()
    {
        // Busca apenas usuários sem role vinculada
        $users = User::doesntHave('roles')->get();

        // Transforma em array pronto para o front
        $usersJson = $users->map(fn($h) => [
            'id'        => $h->id,
            'firstname' => $h->firstname,
            'lastname'  => $h->lastname,
            'phone'     => $h->phone,
            'email'     => $h->email,
            'role'      => $h->roles->first()?->name, // vai ficar null mesmo, já que não tem role
        ]);

        return view('pages.users.pending', [
            'users'     => $users,
            'usersJson' => $usersJson,
        ]);
    }
}
