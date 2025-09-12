<?php

namespace Database\Seeders\Admin;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = "123";
        User::factory()->create([
            'firstname' => 'Leandro',
            'lastname' => 'Oliveira',
            'phone' => '34999749344',
            'role' => 'admin',
            'email' => 'lfoadm@icloud.com',
            'password' => bcrypt($password),
        ]);

        User::factory()->create([
            'firstname' => 'Uelinton',
            'lastname' => 'Martins',
            'phone' => '34999749345',
            'role' => 'manager',
            'email' => 'uel@usinacoruripe.com.br',
            'password' => bcrypt($password),
        ]);

        User::factory()->create([
            'firstname' => 'PIT',
            'lastname' => 'Terminal Iturama',
            'phone' => '34999749346',
            'role' => 'user',
            'email' => 'terminal.iturama@usinacoruripe.com.br',
            'password' => bcrypt($password),
        ]);
    }
}