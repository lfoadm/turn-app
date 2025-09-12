<?php

namespace App\Models\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docking extends Model
{
    /** @use HasFactory<\Database\Factories\Admin\DockingFactory> */
    use HasFactory;

        protected $fillable = [
        'numero_encoste',
        'hora_encoste',
        'situacao_vagoes',
        'qtd_vagoes_total',
        'qtd_vagoes_carregados',
        'qtd_vagoes_recusados',
        'qtd_vagoes_abertos',
        'hora_inicio_carga',
        'hora_fim_carga',
        'hora_partida',
        'peso_proprio',
        'peso_terceiros',
        'prefixo_chegada',
        'prefixo_saida',
        'terminal_id',
        'os_partida_rumo',
        'registro_transporte_coruripe',
        'registro_transporte_terceiros',
        'user_id',
        'port_id',
        'harvest_id',
    ];

    protected $dates = [
        'hora_encoste',
        'hora_inicio_carga',
        'hora_fim_carga',
        'hora_partida',
    ];

    public function stops()
    {
        return $this->hasMany(Stop::class);
    }

    public function port()
    {
        return $this->belongsTo(Port::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function harvest()
    {
        return $this->belongsTo(harvest::class);
    }

    // 📊 Indicadores (Accessors)
    public function getVolumeTotalAttribute()
    {
        return number_format($this->peso_proprio + $this->peso_terceiros, 3, ',', '.');
    }

    public function getVolumeMedioPorVagaoAttribute()
    {
        return $this->qtd_vagoes_carregados > 0
            ? $this->volume_total / $this->qtd_vagoes_carregados
            : 0;
    }

    public function getHoraPartidaFormattedAttribute()
    {
        return Carbon::parse($this->hora_partida)->format('d/m/Y H:i');
    }

    public function getHoraEncosteFormattedAttribute()
    {
        return Carbon::parse($this->hora_encoste)->format('d/m/Y H:i');
    }

    public function getPesoProprioFormattedAttribute()
    {
        return number_format($this->peso_proprio, 3, ',', '.');
    }

    public function getPesoTerceirosFormattedAttribute()
    {
        return number_format($this->peso_terceiros, 3, ',', '.');
    }

    public function getTempoCarregamentoHorasAttribute()
    {
        if ($this->hora_inicio_carga && $this->hora_fim_carga) {
            return $this->hora_fim_carga->diffInMinutes($this->hora_inicio_carga) / 60;
        }
        return 0;
    }

    public function getVagoesPorHoraAttribute()
    {
        return $this->tempo_carregamento_horas > 0
            ? $this->qtd_vagoes_carregados / $this->tempo_carregamento_horas
            : 0;
    }

    public function getToneladasPorHoraAttribute()
    {
        return $this->tempo_carregamento_horas > 0
            ? $this->volume_total / $this->tempo_carregamento_horas
            : 0;
    }

    public function getTempoEsperaInicioCargaAttribute()
    {
        if ($this->hora_encoste && $this->hora_inicio_carga) {
            return $this->hora_inicio_carga->diffInMinutes($this->hora_encoste);
        }
        return 0;
    }

    public function getTempoEsperaPartidaAttribute()
    {
        if ($this->hora_fim_carga && $this->hora_partida) {
            return $this->hora_partida->diffInMinutes($this->hora_fim_carga);
        }
        return 0;
    }

    public function getTempoTotalPatioAttribute()
    {
        if ($this->hora_encoste && $this->hora_partida) {
            return $this->hora_partida->diffInMinutes($this->hora_encoste);
        }
        return 0;
    }

    public function getTempoParadasTotalAttribute()
    {
        return $this->stops->sum('duracao_minutos');
    }

    public function getTaxaAproveitamentoVagoesAttribute()
    {
        return $this->qtd_vagoes_total > 0
            ? ($this->qtd_vagoes_carregados / $this->qtd_vagoes_total) * 100
            : 0;
    }

    public function getTaxaRecusaVagoesAttribute()
    {
        return $this->qtd_vagoes_total > 0
            ? ($this->qtd_vagoes_recusados / $this->qtd_vagoes_total) * 100
            : 0;
    }

    protected $casts = [
        'hora_encoste'     => 'datetime',
        'hora_inicio_carga'=> 'datetime',
        'hora_fim_carga'   => 'datetime',
        'hora_partida'     => 'datetime',
    ];


}
