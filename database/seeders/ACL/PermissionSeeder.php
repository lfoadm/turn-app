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
        Permission::factory()->create([
            'name' => 'role.index',
        ]);

        Permission::factory()->create([
            'name' => 'role.create',
        ]);

        Permission::factory()->create([
            'name' => 'role.store',
        ]);

        Permission::factory()->create([
            'name' => 'role.show',
        ]);

        Permission::factory()->create([
            'name' => 'role.edit',
        ]);

        Permission::factory()->create([
            'name' => 'role.update',
        ]);

        Permission::factory()->create([
            'name' => 'role.destroy',
        ]);
    }
}
