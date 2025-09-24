<?php

namespace App\Policies;

use App\Models\ACL\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('role.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function index(User $user, Role $role): bool
    {
        return $user->hasPermission('role.index');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('role.create');
    }

    public function show(User $user): bool
    {
        return $user->hasPermission('role.show');
    }

    /**
     * Determina se o usuário pode atualizar roles
     */
    public function update(User $user, Role $role): bool
    {
        return $user->hasPermission('role.update');
    }

    /**
     * Determina se o usuário pode deletar roles
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->hasPermission('role.delete');
    }
}
