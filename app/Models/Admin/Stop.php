<?php

namespace App\Models\Admin;

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

    protected $dates = ['hora_inicio', 'hora_fim'];

    public function docking()
    {
        return $this->belongsTo(Docking::class);
    }

    // Calcula a duração ao salvar
    protected static function booted()
    {
        static::saving(function ($stop) {
            if ($stop->hora_inicio && $stop->hora_fim) {
                $stop->duracao_minutos = $stop->hora_fim->diffInMinutes($stop->hora_inicio);
            }
        });
    }
}