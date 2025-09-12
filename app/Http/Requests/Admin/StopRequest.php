<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\Docking;
use Illuminate\Foundation\Http\FormRequest;

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
            'docking_id' => 'required|exists:dockings,id',
            'reason_id'  => 'required|exists:reasons,id',
            'hora_inicio' => 'required|date',
            'hora_fim'    => 'required|date|after:hora_inicio',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $docking = Docking::find($this->docking_id);

            if ($docking) {
                if ($docking->hora_inicio_carga && $this->hora_inicio < $docking->hora_inicio_carga) {
                    $validator->errors()->add('hora_inicio', 'A parada não pode iniciar antes do início da carga.');
                }

                if ($docking->hora_fim_carga && $this->hora_inicio > $docking->hora_fim_carga) {
                    $validator->errors()->add('hora_inicio', 'A parada não pode iniciar após o fim da carga.');
                }

                if ($docking->hora_fim_carga && $this->hora_fim > $docking->hora_fim_carga) {
                    $validator->errors()->add('hora_fim', 'A parada não pode terminar após o fim da carga.');
                }
            }
        });
    }
}
