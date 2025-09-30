<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DockingRequest;
use App\Models\Admin\Docking;
use App\Models\Admin\Harvest;
use App\Models\Admin\Port;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DockingController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->authorize('viewAny',  User::class);
    }

    public function index(Request $request)
    {
        $currencyHarvest = Harvest::where('is_active', true)->first();
        $query = Docking::with('port');

        // Filtro por data
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('hora_encoste', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('hora_encoste', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('hora_encoste', '<=', $request->end_date);
        }

        // Clona a query para não perder os filtros
        $dockingsQuery = clone $query;

        // Indicadores
        $dockingsCount = $dockingsQuery->count();
        $sumCoruripe   = $dockingsQuery->sum('peso_proprio');     // volume coruripe
        $sumRumo       = $dockingsQuery->sum('peso_terceiros');   // volume rumo
        $sumTotal      = $sumCoruripe + $sumRumo;     // volume total carregado

        // Paginação
        $dockings = $query->orderBy('hora_encoste', 'desc')->paginate(50)->withQueryString();

        return view('pages.dockings.index', compact(
            'dockings',
            'dockingsCount',
            'currencyHarvest',
            'sumCoruripe',
            'sumRumo',
            'sumTotal'
        ));
    }


            




    public function create()
    {
        $ports = Port::all();
        $harvests = Harvest::where('is_active', true)->get();
        return view('pages.dockings.create', compact('ports', 'harvests'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'port_id' => 'required',
    //         'hora_encoste' => 'required|date',
    //         'situacao_vagoes' => 'required|in:LIMPOS,SUJOS',

    //         'qtd_vagoes_total' => 'required|integer|min:0',
    //         'qtd_vagoes_carregados' => 'nullable|integer|min:0',
    //         'qtd_vagoes_recusados' => 'nullable|integer|min:0',
    //         'qtd_vagoes_abertos' => 'nullable|integer|min:0',

    //         'hora_inicio_carga' => 'nullable|date',
    //         'hora_fim_carga' => 'nullable|date',
    //         'hora_partida' => 'nullable|date',

    //         'peso_proprio' => 'nullable|numeric',
    //         'peso_terceiros' => 'nullable|numeric',

    //         'prefixo_chegada' => 'nullable|string',
    //         'prefixo_saida' => 'nullable|string',
    //         'os_partida_rumo' => 'nullable|string',
    //         'registro_transporte_coruripe' => 'nullable|string',
    //         'registro_transporte_terceiros' => 'nullable|string',
    //     ]);

    //     // Usuário autenticado
    //     $userId = Auth::id();

    //     // Safra ativa
    //     $harvest = Harvest::where('is_active', 1)->firstOrFail();

    //     // Buscar último encoste dessa safra
    //     $ultimoEncoste = Docking::where('harvest_id', $harvest->id)
    //         ->orderByDesc('id')
    //         ->first();

    //     $proximoNumero = $ultimoEncoste ? ($ultimoEncoste->id + 1) : 1;

    //     // Montar número encoste no formato "NN - 2025/26"
    //     $anoInicial = substr($harvest->title, 0, 4);
    //     $anoFinal = substr($harvest->title, -2);
    //     $numeroEncoste = str_pad($proximoNumero, 2, '0', STR_PAD_LEFT) . " - {$anoInicial}/{$anoFinal}";

    //     $docking = Docking::create([
    //         'port_id' => $request->port_id,
    //         'user_id' => $userId,
    //         'harvest_id' => $harvest->id,

    //         'numero_encoste' => $numeroEncoste,
    //         'hora_encoste' => $request->hora_encoste,
    //         'situacao_vagoes' => $request->situacao_vagoes,

    //         'qtd_vagoes_total' => $request->qtd_vagoes_total,
    //         'qtd_vagoes_carregados' => $request->qtd_vagoes_carregados,
    //         'qtd_vagoes_recusados' => $request->qtd_vagoes_recusados,
    //         'qtd_vagoes_abertos' => $request->qtd_vagoes_abertos,

    //         'hora_inicio_carga' => $request->hora_inicio_carga,
    //         'hora_fim_carga' => $request->hora_fim_carga,
    //         'hora_partida' => $request->hora_partida,

    //         'peso_proprio' => $request->peso_proprio ?? 0,
    //         'peso_terceiros' => $request->peso_terceiros ?? 0,

    //         'prefixo_chegada' => $request->prefixo_chegada,
    //         'prefixo_saida' => $request->prefixo_saida,
    //         'os_partida_rumo' => $request->os_partida_rumo,
    //         'registro_transporte_coruripe' => $request->registro_transporte_coruripe,
    //         'registro_transporte_terceiros' => $request->registro_transporte_terceiros,
    //     ]);

    //     return redirect()->route('dockings.index')->with('success', 'Encoste criado com sucesso!');
    // }

    public function store(DockingRequest $request)
    {
        // dd(validator($request->all())->errors());
        $userId = Auth::id();
        $harvest = Harvest::where('is_active', 1)->firstOrFail();
        $ultimoEncoste = Docking::where('harvest_id', $harvest->id)->orderByDesc('id')->first();
        $proximoNumero = $ultimoEncoste ? ($ultimoEncoste->id + 1) : 1;
        $anoInicial = substr($harvest->title, 0, 4);
        $anoFinal = substr($harvest->title, -2);
        $numeroEncoste = str_pad($proximoNumero, 2, '0', STR_PAD_LEFT) . " - {$anoInicial}/{$anoFinal}";

        Docking::create([
            'port_id' => $request->port_id,
            'user_id' => $userId,
            'harvest_id' => $harvest->id,
            'numero_encoste' => $numeroEncoste,
            'hora_encoste' => $request->hora_encoste,
            'situacao_vagoes' => $request->situacao_vagoes,
            'qtd_vagoes_total' => $request->qtd_vagoes_total,
            'qtd_vagoes_carregados' => $request->qtd_vagoes_carregados,
            'qtd_vagoes_recusados' => $request->qtd_vagoes_recusados,
            'qtd_vagoes_abertos' => $request->qtd_vagoes_abertos,
            'hora_inicio_carga' => $request->hora_inicio_carga,
            'hora_fim_carga' => $request->hora_fim_carga,
            'hora_partida' => $request->hora_partida,
            'peso_proprio' => $request->peso_proprio ?? 0,
            'peso_terceiros' => $request->peso_terceiros ?? 0,
            'prefixo_chegada' => $request->prefixo_chegada,
            'prefixo_saida' => $request->prefixo_saida,
            'os_partida_rumo' => $request->os_partida_rumo,
            'registro_transporte_coruripe' => $request->registro_transporte_coruripe,
            'registro_transporte_terceiros' => $request->registro_transporte_terceiros,
        ]);

        return redirect()->route('dockings.index')->with('success', 'Encoste criado com sucesso!');
    }

    public function edit(Docking $docking)
    {
        $ports = Port::all();
        return view('pages.dockings.edit', compact('docking', 'ports'));
    }

    // public function update(Request $request, Docking $docking)
    // {
    //     // normalizador que transforma "1.234,567" ou "1234,567" -> "1234.567"
    //     $normalize = function ($value) {
    //         if ($value === null || $value === '') {
    //             return null;
    //         }
    //         $v = trim($value);
    //         // remove separadores de milhar (ponto ou espaço)
    //         $v = str_replace(['.', ' '], '', $v);
    //         // troca vírgula por ponto
    //         $v = str_replace(',', '.', $v);
    //         return $v;
    //     };

    //     // merge para o request para que a validação receba o formato correto
    //     $request->merge([
    //         'peso_proprio' => $normalize($request->input('peso_proprio')),
    //         'peso_terceiros' => $normalize($request->input('peso_terceiros')),
    //     ]);
        
    //     $request->validate([
    //         'port_id' => 'required|exists:ports,id',
    //         // 'hora_encoste' => 'required|date',
    //         'situacao_vagoes' => 'required|in:LIMPOS,SUJOS',

    //         'qtd_vagoes_total' => 'required|integer|min:0',
    //         'qtd_vagoes_carregados' => 'nullable|integer|min:0',
    //         'qtd_vagoes_recusados' => 'nullable|integer|min:0',
    //         'qtd_vagoes_abertos' => 'nullable|integer|min:0',

    //         'hora_inicio_carga' => 'nullable|date',
    //         'hora_fim_carga' => 'nullable|date',
    //         'hora_partida' => 'nullable|date',

    //         'peso_proprio' => 'nullable|numeric',
    //         'peso_terceiros' => 'nullable|numeric',

    //         'prefixo_chegada' => 'nullable|string',
    //         'prefixo_saida' => 'nullable|string',
    //         'os_partida_rumo' => 'nullable|string',
    //         'registro_transporte_coruripe' => 'nullable|string',
    //         'registro_transporte_terceiros' => 'nullable|string',
    //     ]);

    //     $docking->update([
    //         'port_id' => $request->port_id,
    //         'hora_encoste' => $request->hora_encoste,
    //         'situacao_vagoes' => $request->situacao_vagoes,

    //         'qtd_vagoes_total' => $request->qtd_vagoes_total,
    //         'qtd_vagoes_carregados' => $request->qtd_vagoes_carregados,
    //         'qtd_vagoes_recusados' => $request->qtd_vagoes_recusados,
    //         'qtd_vagoes_abertos' => $request->qtd_vagoes_abertos,

    //         'hora_inicio_carga' => $request->hora_inicio_carga,
    //         'hora_fim_carga' => $request->hora_fim_carga,
    //         'hora_partida' => $request->hora_partida,

    //         'peso_proprio' => $request->peso_proprio ?? 0,
    //         'peso_terceiros' => $request->peso_terceiros ?? 0,

    //         'prefixo_chegada' => $request->prefixo_chegada,
    //         'prefixo_saida' => $request->prefixo_saida,
    //         'os_partida_rumo' => $request->os_partida_rumo,
    //         'registro_transporte_coruripe' => $request->registro_transporte_coruripe,
    //         'registro_transporte_terceiros' => $request->registro_transporte_terceiros,
    //     ]);

    //     return redirect()->route('dockings.index')->with('success', 'Encoste atualizado com sucesso!');
    // }

    public function update(DockingRequest $request, Docking $docking)
    {
        $docking->update([
            'port_id' => $request->port_id,
            // 'hora_encoste' => $request->hora_encoste,
            'situacao_vagoes' => $request->situacao_vagoes,
            'qtd_vagoes_total' => $request->qtd_vagoes_total,
            'qtd_vagoes_carregados' => $request->qtd_vagoes_carregados,
            'qtd_vagoes_recusados' => $request->qtd_vagoes_recusados,
            'qtd_vagoes_abertos' => $request->qtd_vagoes_abertos,
            'hora_inicio_carga' => $request->hora_inicio_carga,
            'hora_fim_carga' => $request->hora_fim_carga,
            'hora_partida' => $request->hora_partida,
            'peso_proprio' => $request->peso_proprio ?? 0,
            'peso_terceiros' => $request->peso_terceiros ?? 0,
            'prefixo_chegada' => $request->prefixo_chegada,
            'prefixo_saida' => $request->prefixo_saida,
            'os_partida_rumo' => $request->os_partida_rumo,
            'registro_transporte_coruripe' => $request->registro_transporte_coruripe,
            'registro_transporte_terceiros' => $request->registro_transporte_terceiros,
        ]);

        return redirect()->route('dockings.index')->with('success', 'Encoste atualizado com sucesso!');
    }

    public function destroy(Docking $docking)
    {
        $docking->delete();
        return redirect()->route('dockings.index')->with('success', 'Encoste apagado.');
    }

    public function show(Docking $docking)
    {
        // Agrupando tempo de paradas por motivo (usando a relação reason)
        $stopsByReason = $docking->stops
            ->groupBy(fn($stop) => $stop->reason->title ?? 'Sem motivo')
            ->map(fn($stops) => $stops->sum('duracao_minutos'));

        // Preparando dados para gráficos
        $chartLabels = $stopsByReason->keys();
        $chartData = $stopsByReason->values();

        // Vagões
        $openWagons = $docking->qtd_vagoes_abertos;
        $loadedWagons = $docking->qtd_vagoes_carregados;

        // Tempo total das paradas
        $totalStopMinutes = $docking->stops->sum('duracao_minutos');
        // Converte para horas e minutos
        $hours = floor($totalStopMinutes / 60);
        $minutes = $totalStopMinutes % 60;
        // Formata para HH:MM
        $totalStopFormatted = sprintf('%02d:%02d', $hours, $minutes);
        // dd($totalStopFormatted);

        // Tempo de operação (ex.: inicio e fim da carga, descontando paradas)
        $operationMinutes = $docking->hora_inicio_carga && $docking->hora_fim_carga
            ? $docking->hora_inicio_carga->diffInMinutes($docking->hora_fim_carga) - $totalStopMinutes
            : 0;
        //Formatando o tempo de operação para hh:mm
        $hours = floor($operationMinutes / 60);
        $minutes = $operationMinutes % 60;
        $formattedTime = sprintf('%02d:%02d', $hours, $minutes);

        $tonsPerWagon = number_format(($docking->peso_proprio + $docking->peso_terceiros) / $docking->qtd_vagoes_carregados, 3, ',', '.');
        $tonsPerHour = number_format(($docking->peso_proprio + $docking->peso_terceiros) / ($operationMinutes/60), 3, ',', '.');
        
        
        return view('pages.dockings.show', compact(
            'docking',
            'chartLabels',
            'chartData',
            'totalStopMinutes',
            'operationMinutes',
            'openWagons',
            'loadedWagons',
            'totalStopFormatted',
            'formattedTime',
            'tonsPerWagon',
            'tonsPerHour',
        ));
    }

}