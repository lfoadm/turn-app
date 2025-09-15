<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Reason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reason::create([
            'title'     => 'MANOBRA VAGÃO RECUSADO',
            'purge'     => 1,
        ]);

        Reason::create([
            'title'     => 'FALTA DE EQUIPE RUMO',
            'purge'     => 1,
        ]);

        Reason::create([
            'title'     => 'MANOBRA PARA PUXAR O TREM CARREGADO',
            'purge'     => 1,
        ]);

        Reason::create([
            'title'     => 'FECHAMENTO DE VAGÕES',
            'purge'     => 1,
        ]);
    }
}
