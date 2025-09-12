<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Admin\HarvestSeeder;
use Database\Seeders\Admin\PortSeeder;
use Database\Seeders\Admin\UserSeeder;
use Database\Seeders\Admin\DockingSeeder;
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
            // DockingSeeder::class,
        ]);
    }
}
