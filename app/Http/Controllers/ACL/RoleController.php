<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Models\ACL\Permission;
use App\Models\ACL\Role;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();

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

        $data = $this->permissionService->getPermissionsGroupedByModel();

        return view('pages.ACL.roles.show', array_merge($data, [
            'role' => $role,
            'permissionsCount' => $permissionsCount,
        ]));
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
