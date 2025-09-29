<?php

namespace App\Services;

use App\Models\ACL\Permission;
use App\Models\ACL\Role;
use Illuminate\Support\Str;

class PermissionService
{
    /**
     * Agrupa todas as permissões por model e aplica traduções.
     */
    public function getPermissionsGroupedByModel(): array
    {
        // Carrega todas as permissões e agrupa pelo prefixo antes do "."
        $permissionsByModel = Permission::all()->groupBy(function ($permission) {
            return Str::before($permission->name, '.');
        });

        return [
            'permissionsByModel' => $permissionsByModel,
            'modelLabels' => $this->getModelLabels(),
            'actionLabels' => $this->getActionLabels(),
        ];
    }

    /**
     * Traduções dos modelos.
     */
    protected function getModelLabels(): array
    {
        return [
            'user'          => 'Usuários',
            'harvest'       => 'Safras',
            'port'          => 'Terminais portuário',
            'role'          => 'Grupos de usuário',
            'permission'    => 'Permissões de usuário',
            'reason'        => 'Motivos de parada',
            'docking'       => 'Encostes ferroviário',
            'stop'          => 'Paradas',
            'notification'  => 'Notificações',
        ];
    }

    /**
     * Traduções das ações.
     */
    protected function getActionLabels(): array
    {
        return [
            'index'   => 'Listar',
            'create'  => 'Criar',
            'store'   => 'Salvar',
            'show'    => 'Visualizar',
            'edit'    => 'Editar',
            'update'  => 'Atualizar',
            'destroy' => 'Excluir',
        ];
    }


    /**
     * Retorna as roles agrupadas pelo "model_type".
     *
     * @return array
     */
    public function getRolesGroupedByModel(): array
    {
        // Busca todas as roles
        $roles = Role::with('permissions')->get();

        // Agrupa por model (caso use guard_name/model_type ou convenção de nomes)
        $grouped = $roles->groupBy(function ($role) {
            // Se sua Role tiver uma coluna "model" no banco, pode usar direto:
            // return $role->model;

            // Caso não tenha, vamos agrupar pelo prefixo do nome:
            // Exemplo: admin.wagon, editor.wagon -> agrupado em "wagon"
            return Str::before($role->name, '.');
        });

        // Monta um array simples para passar à view
        return $grouped->map(function ($roles, $model) {
            return [
                'model' => $model,
                'roles' => $roles,
            ];
        })->toArray();
    }
    
}
