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
            'name' => 'INDEX_GROUP',
        ]);

        Permission::factory()->create([
            'name' => 'CREATE_GROUP',
        ]);

        Permission::factory()->create([
            'name' => 'STORE_GROUP',
        ]);

        Permission::factory()->create([
            'name' => 'SHOW_GROUP',
        ]);

        Permission::factory()->create([
            'name' => 'EDIT_GROUP',
        ]);

        Permission::factory()->create([
            'name' => 'UPDATE_GROUP',
        ]);

        Permission::factory()->create([
            'name' => 'DESTROY_GROUP',
        ]);
    }
}
