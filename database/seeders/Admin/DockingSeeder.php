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
            'port_id' => 1,
            'user_id' => 1,
            'harvest_id' => 1,
            'numero_encoste' => '01 - 2022/23',
            'hora_encoste' => '2022-09-11 11:05:47',
            'situacao_vagoes' => 'LIMPOS',
            'qtd_vagoes_total' => 80,
            'qtd_vagoes_carregados' => 79,
            'qtd_vagoes_recusados' => 1,
            'qtd_vagoes_abertos' => 8,
            'hora_inicio_carga' => '2022-09-11 11:25:47',
            'hora_fim_carga' => '2022-09-11 11:25:47',
            'hora_partida' => '2022-09-11 11:25:47',
            'peso_proprio' => 5200.500,
            'peso_terceiros' => 2500.250,
            'prefixo_chegada' => 'PRX-01',
            'prefixo_saida' => 'SFX-01',
            'os_partida_rumo' => 'OS-10001',
            'registro_transporte_coruripe' => 'COR-20001',
            'registro_transporte_terceiros' => 'TRC-30001',
        ]);

        Docking::create([
            'port_id' => 1,
            'user_id' => 1,
            'harvest_id' => 1,
            'numero_encoste' => '02 - 2022/23',
            'hora_encoste' => '2022-06-11 10:25:47',
            'situacao_vagoes' => 'SUJOS',
            'qtd_vagoes_total' => 82,
            'qtd_vagoes_carregados' => 82,
            'qtd_vagoes_recusados' => 0,
            'qtd_vagoes_abertos' => 8,
            'hora_inicio_carga' => '2022-06-11 11:25:47',
            'hora_fim_carga' => '2022-06-11 19:30:47',
            'hora_partida' => '2022-06-12 11:25:47',
            'peso_proprio' => 4100.750,
            'peso_terceiros' => 4000.600,
            'prefixo_chegada' => 'PRX-02',
            'prefixo_saida' => 'SFX-02',
            'os_partida_rumo' => 'OS-10002',
            'registro_transporte_coruripe' => 'COR-20002',
            'registro_transporte_terceiros' => 'TRC-30002',
        ]);

        Docking::create([
            'port_id' => 1,
            'user_id' => 1,
            'harvest_id' => 2,
            'numero_encoste' => '03 - 2023/24',
            'hora_encoste' => '2023-07-11 11:00:00',
            'situacao_vagoes' => 'LIMPOS',
            'qtd_vagoes_total' => 100,
            'qtd_vagoes_carregados' => 95,
            'qtd_vagoes_recusados' => 5,
            'qtd_vagoes_abertos' => 10,
            'hora_inicio_carga' => '2023-07-11 12:00:00',
            'hora_fim_carga' => '2023-07-11 19:20:00',
            'hora_partida' => '2023-07-11 19:30:00',
            'peso_proprio' => 2800.000,
            'peso_terceiros' => 1000.400,
            'prefixo_chegada' => 'PRX-03',
            'prefixo_saida' => 'SFX-03',
            'os_partida_rumo' => 'OS-10003',
            'registro_transporte_coruripe' => 'COR-20003',
            'registro_transporte_terceiros' => 'TRC-30003',
        ]);

        Docking::create([
            'port_id' => 1,
            'user_id' => 1,
            'harvest_id' => 3,
            'numero_encoste' => '04 - 2024/25',
            'hora_encoste' => '2024-09-11 01:00:00',
            'situacao_vagoes' => 'SUJOS',
            'qtd_vagoes_total' => 80,
            'qtd_vagoes_carregados' => 75,
            'qtd_vagoes_recusados' => 5,
            'qtd_vagoes_abertos' => 0,
            'hora_inicio_carga' => '2024-09-11 02:00:00',
            'hora_fim_carga' => '2024-09-11 15:45:00',
            'hora_partida' => '2024-09-11 16:00:00',
            'peso_proprio' => 5000.300,
            'peso_terceiros' => 2000.800,
            'prefixo_chegada' => 'PRX-04',
            'prefixo_saida' => 'SFX-04',
            'os_partida_rumo' => 'OS-10004',
            'registro_transporte_coruripe' => 'COR-20004',
            'registro_transporte_terceiros' => 'TRC-30004',
        ]);

        Docking::create([
            'port_id' => 1,
            'user_id' => 1,
            'harvest_id' => 4,
            'numero_encoste' => '05 - 2025/26',
            'hora_encoste' => '2025-07-07 15:45:00',
            'situacao_vagoes' => 'LIMPOS',
            'qtd_vagoes_total' => 80,
            'qtd_vagoes_carregados' => 78,
            'qtd_vagoes_recusados' => 2,
            'qtd_vagoes_abertos' => 8,
            'hora_inicio_carga' => '2025-07-07 16:45:00',
            'hora_fim_carga' => '2025-07-08 02:16:00',
            'hora_partida' => '2025-07-08 05:05:00',
            'peso_proprio' => 3600.900,
            'peso_terceiros' => 1400.200,
            'prefixo_chegada' => 'PRX-05',
            'prefixo_saida' => 'SFX-05',
            'os_partida_rumo' => 'OS-10005',
            'registro_transporte_coruripe' => 'COR-20005',
            'registro_transporte_terceiros' => 'TRC-30005',
        ]);

        Docking::create([
            'port_id' => 1,
            'user_id' => 1,
            'harvest_id' => 4,
            'numero_encoste' => '06 - 2025/26',
            'hora_encoste' => '2025-04-07 10:45:00',
            'situacao_vagoes' => 'SUJOS',
            'qtd_vagoes_total' => 90,
            'qtd_vagoes_carregados' => 87,
            'qtd_vagoes_recusados' => 3,
            'qtd_vagoes_abertos' => 9,
            'hora_inicio_carga' => '2025-04-07 18:45:00',
            'hora_fim_carga' => '2025-04-07 23:45:00',
            'hora_partida' => '2025-04-08 15:45:00',
            'peso_proprio' => 6000.000,
            'peso_terceiros' => 2500.500,
            'prefixo_chegada' => 'PRX-06',
            'prefixo_saida' => 'SFX-06',
            'os_partida_rumo' => 'OS-10006',
            'registro_transporte_coruripe' => 'COR-20006',
            'registro_transporte_terceiros' => 'TRC-30006',
        ]);
    }
}
