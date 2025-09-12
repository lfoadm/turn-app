<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Port;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Port::factory()->create([
            'title' => 'CLI',
            'description' => 'ANTIGO TERMINAL DA RUMO.',
        ]);
        
        Port::factory()->create([
            'title' => 'TAC',
            'description' => 'TERMINAL DA COPERSUCAR.',
        ]);
        
        Port::factory()->create([
            'title' => 'TEAG',
            'description' => 'TERMINAL DO GUARUJÁ.',
        ]);
        
        Port::factory()->create([
            'title' => 'TEC',
            'description' => 'TERMINAL DA COFCO.',
        ]);
    }
}
