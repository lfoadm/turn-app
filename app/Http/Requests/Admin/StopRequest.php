<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\Docking;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'docking_id'  => 'required|exists:dockings,id',
            'reason_id'   => 'required|exists:reasons,id',
            'hora_inicio' => 'required|date',
            'hora_fim'    => 'required|date|after:hora_inicio',
        ];
    }

    /**
     * Validações adicionais após as regras básicas.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $docking = Docking::find($this->docking_id);

            if (!$docking) {
                return;
            }

            $horaInicio = Carbon::parse($this->hora_inicio);
            $horaFim    = Carbon::parse($this->hora_fim);

            $cargaInicio = $docking->hora_inicio_carga ? Carbon::parse($docking->hora_inicio_carga) : null;
            $cargaFim    = $docking->hora_fim_carga ? Carbon::parse($docking->hora_fim_carga) : null;

            if ($cargaInicio && $horaInicio->lt($cargaInicio)) {
                $validator->errors()->add('hora_inicio', 'A parada não pode iniciar antes do início da carga.');
            }

            if ($cargaFim && $horaInicio->gt($cargaFim)) {
                $validator->errors()->add('hora_inicio', 'A parada não pode iniciar após o fim da carga.');
            }

            if ($cargaFim && $horaFim->gt($cargaFim)) {
                $validator->errors()->add('hora_fim', 'A parada não pode terminar após o fim da carga.');
            }

            // Validação extra: garantir que toda a parada está dentro do intervalo do docking
            if ($cargaInicio && $cargaFim) {
                if ($horaInicio->lt($cargaInicio) || $horaFim->gt($cargaFim)) {
                    $validator->errors()->add('intervalo', 'A parada deve estar totalmente dentro do intervalo da carga.');
                }
            }
        });
    }
}
