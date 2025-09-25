<?php

namespace App\Services;

use App\Models\ACL\Permission;
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
}
