<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Models\ACL\Permission;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $permissions = Permission::withCount('roles')->orderBy('id', 'DESC')->get();

        // Transforma em array pronto para o front
        $permissionsJson = $permissions->map(fn($h) => [
            'id'        => $h->id,
            'name'     => $h->name,
            'roles_count' => $h->roles_count, // quantidade de grupos vinculados
        ]);

        return view('pages.ACL.permissions.index', [
            'permissions'     => $permissions,
            'permissionsJson' => $permissionsJson,
        ]);
    }

    public function create()
    {
        return view('pages.ACL.permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        Permission::create($validated);

        return redirect()->route('permissions.index')->with('success', 'Permissão de acesso criada com sucesso');
    }

    public function show($id)
    {
        // Busca a permission com as roles relacionadas
        $permission = Permission::with('roles')->findOrFail($id);

        // Quantidade de roles vinculadas
        $rolesCount = $permission->roles->count();

        // Caso você queira organizar as roles por algum critério, pode vir do service
        $data = $this->permissionService->getRolesGroupedByModel();

        return view('pages.ACL.permissions.show', [
            'permission' => $permission,
            'roles'      => $permission->roles, // lista das roles vinculadas
            'rolesCount' => $rolesCount,
            ...$data, // junta com os dados adicionais do service
        ]);
    }

    public function edit(Permission $permission)
    {
        return view('pages.ACL.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $permission->update($validated);

        return redirect()->route('permissions.index')->with('success', 'Permissão de acesso atualizada com sucesso.');
    }
}
