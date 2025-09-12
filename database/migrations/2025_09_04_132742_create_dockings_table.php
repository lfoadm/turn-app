<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dockings', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('port_id')->constrained('ports');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('harvest_id')->constrained()->onDelete('cascade');

            $table->string('numero_encoste'); // ex: 03 - 2025/26
            $table->timestamp('hora_encoste');
            $table->enum('situacao_vagoes', ['LIMPOS', 'SUJOS'])->default('LIMPOS');

            $table->integer('qtd_vagoes_total');
            $table->integer('qtd_vagoes_carregados')->nullable();
            $table->integer('qtd_vagoes_recusados')->nullable();
            $table->integer('qtd_vagoes_abertos')->nullable();

            $table->timestamp('hora_inicio_carga')->nullable();
            $table->timestamp('hora_fim_carga')->nullable();
            $table->timestamp('hora_partida')->nullable();

            $table->decimal('peso_proprio', 10, 3)->default(0);
            $table->decimal('peso_terceiros', 10, 3)->default(0);

            $table->string('prefixo_chegada')->nullable();
            $table->string('prefixo_saida')->nullable();
            $table->string('os_partida_rumo')->nullable();
            $table->string('registro_transporte_coruripe')->nullable();
            $table->string('registro_transporte_terceiros')->nullable();

            $table->enum('status', ['departed', 'operating', 'waiting_to_depart', 'waiting_to_start'])->default('waiting_to_start');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dockings');
    }
};
