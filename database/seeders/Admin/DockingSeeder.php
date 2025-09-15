<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Docking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DockingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Docking::create([
            'port_id' => 1, // 1:CLI / 2:TAC / 3:TEAG / 4:TEC
            'user_id' => 1,
            'harvest_id' => 4,
            'numero_encoste' => '86 - 2025/26',
            'hora_encoste' => '2025-09-01 12:16:00',
            'situacao_vagoes' => 'LIMPOS',
            'qtd_vagoes_total' => 78,
            'qtd_vagoes_carregados' => 78,
            'qtd_vagoes_recusados' => 0,
            'qtd_vagoes_abertos' => 11,
            'hora_inicio_carga' => '2025-09-01 14:15:00',
            'hora_fim_carga' => '2025-09-01 22:42:00',
            'hora_partida' => '2025-09-03 19:28:00',
            'peso_proprio' => 4008.769,
            'peso_terceiros' => 3826.686,
            'prefixo_chegada' => 'R85',
            'prefixo_saida' => 'R86',
            'os_partida_rumo' => '2033124',
            'registro_transporte_coruripe' => '1637',
            'registro_transporte_terceiros' => '889905-889915-889916-889919',
        ]);

        Docking::create([
            'port_id' => 3, // 1:CLI / 2:TAC / 3:TEAG / 4:TEC
            'user_id' => 1,
            'harvest_id' => 4,
            'numero_encoste' => '87 - 2025/26',
            'hora_encoste' => '2025-09-04 23:31:00',
            'situacao_vagoes' => 'LIMPOS',
            'qtd_vagoes_total' => 82,
            'qtd_vagoes_carregados' => 79,
            'qtd_vagoes_recusados' => 3,
            'qtd_vagoes_abertos' => 0,
            'hora_inicio_carga' => '2025-09-04 23:48:00',
            'hora_fim_carga' => '2025-09-05 08:10:00',
            'hora_partida' => '2025-09-05 10:35:00',
            'peso_proprio' => 203.179,
            'peso_terceiros' => 7714.891,
            'prefixo_chegada' => 'R81',
            'prefixo_saida' => 'R82',
            'os_partida_rumo' => '2033796',
            'registro_transporte_coruripe' => '1638',
            'registro_transporte_terceiros' => '880694-880695-880696',
        ]);

        Docking::create([
            'port_id' => 2, // 1:CLI / 2:TAC / 3:TEAG / 4:TEC
            'user_id' => 1,
            'harvest_id' => 4,
            'numero_encoste' => '88 - 2025/26',
            'hora_encoste' => '2025-09-05 17:46:00',
            'situacao_vagoes' => 'LIMPOS',
            'qtd_vagoes_total' => 85,
            'qtd_vagoes_carregados' => 79,
            'qtd_vagoes_recusados' => 6,
            'qtd_vagoes_abertos' => 26,
            'hora_inicio_carga' => '2025-09-05 17:55:00',
            'hora_fim_carga' => '2025-09-06 01:37:00',
            'hora_partida' => '2025-09-06 11:50:00',
            'peso_proprio' => 5911.453,
            'peso_terceiros' => 2000.210,
            'prefixo_chegada' => 'R85',
            'prefixo_saida' => 'R86',
            'os_partida_rumo' => '2033999',
            'registro_transporte_coruripe' => '1640',
            'registro_transporte_terceiros' => '890884-890885-890886',
        ]);

        Docking::create([
            'port_id' => 3, // 1:CLI / 2:TAC / 3:TEAG / 4:TEC
            'user_id' => 1,
            'harvest_id' => 4,
            'numero_encoste' => '89 - 2025/26',
            'hora_encoste' => '2025-09-06 05:42:00',
            'situacao_vagoes' => 'LIMPOS',
            'qtd_vagoes_total' => 79,
            'qtd_vagoes_carregados' => 79,
            'qtd_vagoes_recusados' => 0,
            'qtd_vagoes_abertos' => 33,
            'hora_inicio_carga' => '2025-09-06 05:54:00',
            'hora_fim_carga' => '2025-09-06 12:00:00',
            'hora_partida' => '2025-09-08 08:22:00',
            'peso_proprio' => 3970.141,
            'peso_terceiros' => 3928.002,
            'prefixo_chegada' => 'R81',
            'prefixo_saida' => 'R82',
            'os_partida_rumo' => '2034016',
            'registro_transporte_coruripe' => '1641',
            'registro_transporte_terceiros' => '891014-891015-891016',
        ]);

        Docking::create([
            'port_id'                       => 1, // 1:CLI / 2:TAC / 3:TEAG / 4:TEC
            'user_id'                       => 1,
            'harvest_id'                    => 4,
            'numero_encoste'                => '90 - 2025/26',
            'hora_encoste'                  => '2025-09-08 08:27:00',
            'situacao_vagoes'               => 'LIMPOS',
            'qtd_vagoes_total'              => 79,
            'qtd_vagoes_carregados'         => 79,
            'qtd_vagoes_recusados'          => 0,
            'qtd_vagoes_abertos'            => 38,
            'hora_inicio_carga'             => '2025-09-08 08:39:00',
            'hora_fim_carga'                => '2025-09-08 20:54:00',
            'hora_partida'                  => '2025-09-11 11:52:00',
            'peso_proprio'                  => 3970.256,
            'peso_terceiros'                => 3909.396,
            'prefixo_chegada'               => 'R83',
            'prefixo_saida'                 => 'R84',
            'os_partida_rumo'               => '2034351',
            'registro_transporte_coruripe'  => '1642',
            'registro_transporte_terceiros' => '891352-891473-891483',
        ]);

        Docking::create([
            'port_id'                       => 2, // 1:CLI / 2:TAC / 3:TEAG / 4:TEC
            'user_id'                       => 1,
            'harvest_id'                    => 4,
            'numero_encoste'                => '91 - 2025/26',
            'hora_encoste'                  => '2025-09-09 03:07:00',
            'situacao_vagoes'               => 'LIMPOS',
            'qtd_vagoes_total'              => 74,
            'qtd_vagoes_carregados'         => 72,
            'qtd_vagoes_recusados'          => 2,
            'qtd_vagoes_abertos'            => 35,
            'hora_inicio_carga'             => '2025-09-09 03:18:00',
            'hora_fim_carga'                => '2025-09-09 16:36:00',
            'hora_partida'                  => '2025-09-11 13:57:00',
            'peso_proprio'                  => 6134.542,
            'peso_terceiros'                => 1109.891,
            'prefixo_chegada'               => 'R85',
            'prefixo_saida'                 => 'R86',
            'os_partida_rumo'               => '2034530',
            'registro_transporte_coruripe'  => '1643',
            'registro_transporte_terceiros' => '891572-891573-891574-891652',
        ]);

        Docking::create([
            'port_id'                       => 3, // 1:CLI / 2:TAC / 3:TEAG / 4:TEC
            'user_id'                       => 1,
            'harvest_id'                    => 4,
            'numero_encoste'                => '92 - 2025/26',
            'hora_encoste'                  => '2025-09-11 23:39:00',
            'situacao_vagoes'               => 'LIMPOS',
            'qtd_vagoes_total'              => 79,
            'qtd_vagoes_carregados'         => 78,
            'qtd_vagoes_recusados'          => 1,
            'qtd_vagoes_abertos'            => 45,
            'hora_inicio_carga'             => '2025-09-11 23:48:00',
            'hora_fim_carga'                => '2025-09-12 05:20:00',
            'hora_partida'                  => '2025-09-12 12:37:00',
            'peso_proprio'                  => 0,
            'peso_terceiros'                => 7835.238,
            'prefixo_chegada'               => 'R87',
            'prefixo_saida'                 => 'R88',
            'os_partida_rumo'               => '2035027',
            'registro_transporte_coruripe'  => '1644',
            'registro_transporte_terceiros' => '-',
        ]);

        Docking::create([
            'port_id'                       => 1, // 1:CLI / 2:TAC / 3:TEAG / 4:TEC
            'user_id'                       => 1,
            'harvest_id'                    => 4,
            'numero_encoste'                => '93 - 2025/26',
            'hora_encoste'                  => '2025-09-13 01:00:00',
            'situacao_vagoes'               => 'LIMPOS',
            'qtd_vagoes_total'              => 83,
            'qtd_vagoes_carregados'         => 80,
            'qtd_vagoes_recusados'          => 3,
            'qtd_vagoes_abertos'            => 57,
            'hora_inicio_carga'             => '2025-09-13 01:16:00',
            'hora_fim_carga'                => '2025-09-13 10:34:00',
            'hora_partida'                  => '2025-09-14 08:48:00',
            'peso_proprio'                  => 8038.951,
            'peso_terceiros'                => 0,
            'prefixo_chegada'               => 'R89',
            'prefixo_saida'                 => 'R80',
            'os_partida_rumo'               => '2035222',
            // 'registro_transporte_coruripe'  => '-',
            'registro_transporte_terceiros' => '892454-892455-892456',
        ]);

        Docking::create([
            'port_id'                       => 3, // 1:CLI / 2:TAC / 3:TEAG / 4:TEC
            'user_id'                       => 1,
            'harvest_id'                    => 4,
            'numero_encoste'                => '94 - 2025/26',
            'hora_encoste'                  => '2025-09-14 13:07:00',
            'situacao_vagoes'               => 'LIMPOS',
            'qtd_vagoes_total'              => 79,
            'qtd_vagoes_carregados'         => 79,
            'qtd_vagoes_recusados'          => 0,
            'qtd_vagoes_abertos'            => 16,
            'hora_inicio_carga'             => '2025-09-14 13:10:00',
            'hora_fim_carga'                => '2025-09-14 19:46:00',
            // 'hora_partida'                  => '2025-09-14 08:48:00',
            'peso_proprio'                  => 0,
            'peso_terceiros'                => 7923.642,
            'prefixo_chegada'               => 'R81',
            'prefixo_saida'                 => 'R82',
            'os_partida_rumo'               => '2035548',
            'registro_transporte_coruripe'  => '1645',
            // 'registro_transporte_terceiros' => '-',
        ]);
    }
}
