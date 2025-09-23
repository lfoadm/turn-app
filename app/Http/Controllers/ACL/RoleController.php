<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Models\ACL\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->get();

        // Transforma em array pronto para o front
        $rolesJson = $roles->map(fn($h) => [
            'id'        => $h->id,
            'name'     => $h->name,
        ]);

        return view('pages.ACL.roles.index', [
            'roles'     => $roles,
            'rolesJson' => $rolesJson,
        ]);
    }

    public function create()
    {
        return view('pages.ACL.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        Role::create($validated);

        return redirect()->route('roles.index')->with('success', 'Grupo de usuário cadastrado com sucesso');
    }

    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $permissionsCount = $role->permissions->count();

        // Agrupa todas as permissões cadastradas no sistema por Policy
        $permissionsByPolicy = \App\Models\ACL\Permission::all()->groupBy('policy');

        return view('pages.ACL.roles.show', [
            'role' => $role,
            'permissionsCount' => $permissionsCount,
            'permissionsByPolicy' => $permissionsByPolicy,
        ]);
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Sincroniza as permissões do papel (role)
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.show', $role->id)
            ->with('success', 'Permissões atualizadas com sucesso!');
    }

}
