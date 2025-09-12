<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DockingRequest extends FormRequest
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
        $status = $this->input('status'); // pega o status atual do request

        // Regras básicas
        $rules = [
            'port_id' => 'required|exists:ports,id',
            'hora_encoste' => 'required|date',
            'situacao_vagoes' => 'required|in:LIMPOS,SUJOS',

            'qtd_vagoes_total' => 'required|integer|min:0',
            'peso_proprio' => 'nullable|numeric',
            'peso_terceiros' => 'nullable|numeric',

            'status' => 'nullable|in:waiting,progress,finished',
        ];

        // Se status = finalizado → exige os campos antes nullable
        if ($status === 'finalizado') {
            $rules = array_merge($rules, [
                'qtd_vagoes_carregados' => 'required|integer|min:0',
                'qtd_vagoes_recusados' => 'required|integer|min:0',
                'qtd_vagoes_abertos' => 'required|integer|min:0',

                'hora_inicio_carga' => 'required|date',
                'hora_fim_carga' => 'required|date',
                'hora_partida' => 'required|date',

                'prefixo_chegada' => 'required|string',
                'prefixo_saida' => 'required|string',
                'os_partida_rumo' => 'required|string',
                'registro_transporte_coruripe' => 'required|string',
                'registro_transporte_terceiros' => 'required|string',
            ]);
        } else {
            // nos outros status, ficam opcionais
            $rules = array_merge($rules, [
                'qtd_vagoes_carregados' => 'nullable|integer|min:0',
                'qtd_vagoes_recusados' => 'nullable|integer|min:0',
                'qtd_vagoes_abertos' => 'nullable|integer|min:0',

                'hora_inicio_carga' => 'nullable|date',
                'hora_fim_carga' => 'nullable|date',
                'hora_partida' => 'nullable|date',

                'prefixo_chegada' => 'nullable|string',
                'prefixo_saida' => 'nullable|string',
                'os_partida_rumo' => 'nullable|string',
                'registro_transporte_coruripe' => 'nullable|string',
                'registro_transporte_terceiros' => 'nullable|string',
            ]);
        }

        return $rules;
    }
}
