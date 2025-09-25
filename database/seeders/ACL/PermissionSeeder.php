<?php

namespace Database\Seeders\ACL;

use App\Models\ACL\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role.index',
            'role.create',
            'role.store',
            'role.show',
            'role.edit',
            'role.update',
            'role.destroy',

            'user.index',
            'user.create',
            'user.store',
            'user.show',
            'user.edit',
            'user.update',
            'user.destroy',

            'harvest.index',
            'harvest.create',
            'harvest.store',
            'harvest.show',
            'harvest.edit',
            'harvest.update',
            'harvest.destroy',

            'port.index',
            'port.create',
            'port.store',
            'port.show',
            'port.edit',
            'port.update',
            'port.destroy',

            'permission.index',
            'permission.create',
            'permission.store',
            'permission.show',
            'permission.edit',
            'permission.update',
            'permission.destroy',

            'reason.index',
            'reason.create',
            'reason.store',
            'reason.show',
            'reason.edit',
            'reason.update',
            'reason.destroy',

            'docking.index',
            'docking.create',
            'docking.store',
            'docking.show',
            'docking.edit',
            'docking.update',
            'docking.destroy',

            'stop.index',
            'stop.create',
            'stop.store',
            'stop.show',
            'stop.edit',
            'stop.update',
            'stop.destroy',

            'notification.index',
            'notification.create',
            'notification.store',
            'notification.show',
            'notification.edit',
            'notification.update',
            'notification.destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::factory()->create([
                'name' => $permission,
            ]);
        }
    }
}