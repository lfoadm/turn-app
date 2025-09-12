<?php

namespace App\Models\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    /** @use HasFactory<\Database\Factories\Admin\StopFactory> */
    use HasFactory;

    protected $fillable = [
        'docking_id',
        'hora_inicio',
        'hora_fim',
        'duracao_minutos',
        'motivo',
        'user_id',
    ];

    public function getHoraInicioFormattedAttribute()
    {
        return Carbon::parse($this->hora_inicio)->format('d/m/Y H:i');
    }

    public function getHoraFimFormattedAttribute()
    {
        return Carbon::parse($this->hora_fim)->format('d/m/Y H:i');
    }

    protected $dates = ['hora_inicio', 'hora_fim'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function docking()
    {
        return $this->belongsTo(Docking::class);
    }

    // Calcula a duração ao salvar
    protected static function booted()
    {
        static::saving(function ($stop) {
            if ($stop->hora_inicio && $stop->hora_fim) {
                $stop->duracao_minutos = $stop->hora_inicio->diffInMinutes($stop->hora_fim);
            }
        });
    }

    protected $casts = [
        'hora_inicio'   => 'datetime',
        'hora_fim'      => 'datetime',
    ];
}