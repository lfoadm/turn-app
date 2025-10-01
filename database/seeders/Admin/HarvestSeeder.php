<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Harvest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HarvestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Harvest::create([
            'title' => '2022/23',
            'is_active' => 0,
        ]);

        Harvest::create([
            'title' => '2023/24',
            'is_active' => 0,
        ]);

        Harvest::create([
            'title' => '2024/25',
            'is_active' => 0,
        ]);

        Harvest::create([
            'title' => '2025/26',
            'is_active' => 1,
        ]);
    }
}
