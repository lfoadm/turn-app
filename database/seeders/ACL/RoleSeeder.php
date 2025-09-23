<?php

namespace Database\Seeders\ACL;

use App\Models\ACL\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => 'SUPER',
        ]);

        Role::factory()->create([
            'name' => 'ADMIN',
        ]);

        Role::factory()->create([
            'name' => 'USER',
        ]);
    }
}
