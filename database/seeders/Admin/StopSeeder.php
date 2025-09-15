<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Stop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stop::create([
            'docking_id'        => 1,
            'reason_id'         => 1,
            'user_id'           => 1,
            'hora_inicio'       => '2025-09-01 15:00:00',
            'hora_fim'          => '2025-09-01 18:07:00',
            //'duracao_minutos'   => 187,
            'description'       => 'Descrição do carregamento 01/09',
        ]);

        Stop::create([
            'docking_id'        => 2,
            'reason_id'         => 1,
            'user_id'           => 1,
            'hora_inicio'       => '2025-09-05 02:00:00',
            'hora_fim'          => '2025-09-05 05:00:00',
            //'duracao_minutos'   => 180,
            'description'       => 'Descrição do carregamento 05/09',
        ]);

        Stop::create([
            'docking_id'        => 3,
            'reason_id'         => 1,
            'user_id'           => 1,
            'hora_inicio'       => '2025-09-05 21:00:00',
            'hora_fim'          => '2025-09-05 23:10:00',
            //'duracao_minutos'   => 130,
            'description'       => 'Descrição do carregamento 05/09',
        ]);

        Stop::create([
            'docking_id'        => 4,
            'reason_id'         => 1,
            'user_id'           => 1,
            'hora_inicio'       => '2025-09-06 07:00:00',
            'hora_fim'          => '2025-09-06 08:00:00',
            //'duracao_minutos'   => 120,
            'description'       => 'Descrição do carregamento 06/09',
        ]);

        Stop::create([
            'docking_id'        => 5,
            'reason_id'         => 1,
            'user_id'           => 1,
            'hora_inicio'       => '2025-09-08 10:00:00',
            'hora_fim'          => '2025-09-08 16:45:00',
            //'duracao_minutos'   => 405,
            'description'       => 'Descrição do carregamento 08/09',
        ]);

        Stop::create([
            'docking_id'        => 6,
            'reason_id'         => 1,
            'user_id'           => 1,
            'hora_inicio'       => '2025-09-09 05:00:00',
            'hora_fim'          => '2025-09-09 12:31:00',
            //'duracao_minutos'   => 451,
            'description'       => 'Descrição do carregamento 09/09',
        ]);

        Stop::create([
            'docking_id'        => 8,
            'reason_id'         => 1,
            'user_id'           => 1,
            'hora_inicio'       => '2025-09-13 03:00:00',
            'hora_fim'          => '2025-09-13 06:24:00',
            //'duracao_minutos'   => 154,
            'description'       => 'Descrição do carregamento 13/09',
        ]);

        Stop::create([
            'docking_id'        => 9,
            'reason_id'         => 1,
            'user_id'           => 1,
            'hora_inicio'       => '2025-09-14 15:00:00',
            'hora_fim'          => '2025-09-14 15:55:00',
            //'duracao_minutos'   => 55,
            'description'       => 'Descrição do carregamento 14/09',
        ]);
    }
}
