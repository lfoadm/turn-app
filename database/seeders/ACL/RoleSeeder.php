<?php

namespace Database\Seeders\ACL;

use App\Models\ACL\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria as roles
        $super = Role::create(['name' => 'SUPER']);
        $admin = Role::create(['name' => 'ADMIN']);
        $user  = Role::create(['name' => 'USER']);

        User::find(1)->roles()->attach($super->id);
        User::find(2)->roles()->attach($admin->id);
        User::find(3)->roles()->attach($user->id);
    }
}