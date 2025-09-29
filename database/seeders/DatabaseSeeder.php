<?php

namespace Database\Seeders;

use App\Models\Admin\Harvest;
use App\Models\User;
use Database\Seeders\ACL\PermissionSeeder;
use Database\Seeders\ACL\RoleSeeder;
use Database\Seeders\Admin\HarvestSeeder;
use Database\Seeders\Admin\PortSeeder;
use Database\Seeders\Admin\UserSeeder;
use Database\Seeders\Admin\DockingSeeder;
use Database\Seeders\Admin\ReasonSeeder;
use Database\Seeders\Admin\StopSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([ 
            UserSeeder::class,
            HarvestSeeder::class,
            PortSeeder::class,
            ReasonSeeder::class,
            // DockingSeeder::class,
            // StopSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);

        // User::factory(199)->create();

    }
}
