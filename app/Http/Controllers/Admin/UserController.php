<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewUser\UserCreateEvent;
use App\Http\Controllers\Controller;
use App\Mail\NewUser\UserCreateMail;
use App\Models\ACL\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        // Transforma em array pronto para o front
        $usersJson = $users->map(fn($h) => [
            'id'            => $h->id,
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

    public function create()
    {
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'nullable|string|max:20',
            'role_id'   => 'required|exists:roles,id',
        ]);
        
        // 🔑 Gerar senha temporária
        $temporaryPassword = Str::random(8);
        
        // Criar usuário
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($temporaryPassword),
        ]);
        
        // Vincular role
        $user->roles()->attach($request->role_id);

        UserCreateEvent::dispatch($user, $temporaryPassword);
        
        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso e senha temporária enviada.');
    }
}
