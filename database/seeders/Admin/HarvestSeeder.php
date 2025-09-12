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
        Harvest::factory()->create([
            'title' => '2022/23',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2023/24',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2024/25',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2025/26',
            'is_active' => 1,
        ]);

        Harvest::factory()->create([
            'title' => '2026/27',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2027/28',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2028/29',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2029/30',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2030/31',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2031/32',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2032/33',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2033/34',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2034/35',
            'is_active' => 0,
        ]);

        Harvest::factory()->create([
            'title' => '2035/36',
            'is_active' => 0,
        ]);
    }
}
