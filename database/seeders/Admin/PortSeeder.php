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
        Port::create([
            'title' => 'CLI',
            'description' => 'ANTIGO TERMINAL DA RUMO.',
        ]);
        
        Port::create([
            'title' => 'TAC',
            'description' => 'TERMINAL DA COPERSUCAR.',
        ]);
        
        Port::create([
            'title' => 'TEAG',
            'description' => 'TERMINAL DO GUARUJÁ.',
        ]);
        
        Port::create([
            'title' => 'TEC',
            'description' => 'TERMINAL DA COFCO.',
        ]);
    }
}
