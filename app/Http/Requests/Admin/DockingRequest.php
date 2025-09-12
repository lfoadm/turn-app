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
        $status = $this->input('status'); // pega o status do encoste

        // Regras básicas
        $rules = [
            'port_id'         => 'required|exists:ports,id',
            'hora_encoste'    => 'required|date',
            'situacao_vagoes' => 'required|in:LIMPOS,SUJOS',

            'qtd_vagoes_total'     => 'required|integer|min:0',
            'peso_proprio'         => 'nullable|numeric',
            'peso_terceiros'       => 'nullable|numeric',

            'status' => 'nullable|in:waiting,progress,finished',
        ];

        // Campos obrigatórios quando o status for finalizado
        if ($status === 'finished' || $status === 'finalizado') {
            $rules = array_merge($rules, [
                'qtd_vagoes_carregados' => 'required|integer|min:0',
                'qtd_vagoes_recusados'  => 'required|integer|min:0',
                'qtd_vagoes_abertos'    => 'required|integer|min:0',

                'hora_inicio_carga' => 'required|date|after_or_equal:hora_encoste',
                'hora_fim_carga'    => 'required|date|after_or_equal:hora_inicio_carga',
                'hora_partida'      => 'required|date|after_or_equal:hora_fim_carga',

                'prefixo_chegada'                => 'required|string',
                'prefixo_saida'                  => 'required|string',
                'os_partida_rumo'                => 'required|string',
                'registro_transporte_coruripe'   => 'required|string',
                'registro_transporte_terceiros'  => 'required|string',
            ]);
        } else {
            // Nos outros status, opcionais
            $rules = array_merge($rules, [
                'qtd_vagoes_carregados' => 'nullable|integer|min:0',
                'qtd_vagoes_recusados'  => 'nullable|integer|min:0',
                'qtd_vagoes_abertos'    => 'nullable|integer|min:0',

                'hora_inicio_carga' => 'nullable|date|after_or_equal:hora_encoste',
                'hora_fim_carga'    => 'nullable|date|after_or_equal:hora_inicio_carga',
                'hora_partida'      => 'nullable|date|after_or_equal:hora_fim_carga',

                'prefixo_chegada'                => 'nullable|string',
                'prefixo_saida'                  => 'nullable|string',
                'os_partida_rumo'                => 'nullable|string',
                'registro_transporte_coruripe'   => 'nullable|string',
                'registro_transporte_terceiros'  => 'nullable|string',
            ]);
        }

        return $rules;
    }

    /**
     * Mensagens personalizadas
     */
    public function messages(): array
    {
        return [
            'hora_inicio_carga.after_or_equal' => 'O início da carga não pode ser anterior ao horário de encoste.',
            'hora_fim_carga.after_or_equal'    => 'O fim da carga não pode ser anterior ao início da carga.',
            'hora_partida.after_or_equal'      => 'A partida não pode ser anterior ao fim da carga.',
        ];
    }
}
