<?php

namespace Database\Factories;

use App\Models\Admin\Docking;
use App\Models\Admin\Port;
use App\Models\User;
use App\Models\Admin\Harvest;
use Illuminate\Database\Eloquent\Factories\Factory;

class DockingFactory extends Factory
{
    protected $model = Docking::class;

    public function definition(): array
    {
        return [
            'port_id' => Port::factory(),
            'user_id' => User::factory(),
            'harvest_id' => Harvest::factory(),

            'numero_encoste' => $this->faker->numerify('0#/2025'),
            'hora_encoste' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'situacao_vagoes' => $this->faker->randomElement(['LIMPOS', 'SUJOS']),

            'qtd_vagoes_total' => $this->faker->numberBetween(10, 20),
            'qtd_vagoes_carregados' => $this->faker->numberBetween(5, 15),
            'qtd_vagoes_recusados' => $this->faker->numberBetween(0, 2),
            'qtd_vagoes_abertos' => $this->faker->numberBetween(0, 5),

            'hora_inicio_carga' => $this->faker->optional()->dateTimeBetween('-6 days', 'now'),
            'hora_fim_carga' => $this->faker->optional()->dateTimeBetween('-5 days', 'now'),
            'hora_partida' => $this->faker->optional()->dateTimeBetween('-4 days', 'now'),

            'peso_proprio' => $this->faker->randomFloat(3, 1000, 5000),
            'peso_terceiros' => $this->faker->randomFloat(3, 500, 3000),

            'prefixo_chegada' => $this->faker->lexify('PRFX-??'),
            'prefixo_saida' => $this->faker->lexify('SFX-??'),

            'os_partida_rumo' => $this->faker->numerify('OS-#####'),
            'registro_transporte_coruripe' => $this->faker->numerify('COR-#####'),
            'registro_transporte_terceiros' => $this->faker->numerify('TRC-#####'),
        ];
    }
}
