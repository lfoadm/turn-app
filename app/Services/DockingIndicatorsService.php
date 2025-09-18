<?php

namespace App\Services;

use App\Models\Admin\Docking;
use App\Models\Admin\Harvest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DockingIndicatorsService
{
    /**
     * Calcula indicadores sempre considerando a safra ativa.
     *
     * @param Builder|null $query - Query já com filtros aplicados (datas, porto, etc).
     * @return array
     */
    public function calculate(?Builder $query = null): array
    {
        // Query base
        $query = $query ?? Docking::with('port');

        // --- Buscar safra ativa ---
        $activeHarvests = Harvest::where('is_active', true)->get();

        if ($activeHarvests->count() === 0) {
            return $this->emptyIndicators(null, 'Nenhuma safra ativa encontrada.');
        }

        if ($activeHarvests->count() > 1) {
            return $this->emptyIndicators(null, 'Existe mais de uma safra ativa. Verifique o cadastro.');
        }

        $selectedHarvest = $activeHarvests->first();

        // filtra a query pela safra ativa
        $query->where('harvest_id', $selectedHarvest->id);

        // executa a query
        $dockings = (clone $query)->get();

        if ($dockings->isEmpty()) {
            return $this->emptyIndicators($selectedHarvest);
        }

        // Totais
        $sumCoruripe = $dockings->sum('peso_proprio');
        $sumRumo     = $dockings->sum('peso_terceiros');
        $sumTotal    = $sumCoruripe + $sumRumo;

        $dockingsCount = $dockings->count();

        // --- Média ton/vagão ---
        $avgTonPerWagon = $dockings
            ->filter(fn($d) => $d->qtd_vagoes_carregados > 0)
            ->map(fn($d) => (($d->peso_proprio + $d->peso_terceiros) / $d->qtd_vagoes_carregados))
            ->avg() ?? 0;
        $avgTonPerWagon = round($avgTonPerWagon, 2);

        // --- Média vagões/hora ---
        $avgWagonsPerHour = $dockings
            ->filter(fn($d) => $d->hora_inicio_carga && $d->hora_fim_carga && $d->qtd_vagoes_carregados > 0)
            ->map(fn($d) => $this->ratePerHour($d->hora_inicio_carga, $d->hora_fim_carga, $d->qtd_vagoes_carregados))
            ->filter()
            ->avg() ?? 0;
        $avgWagonsPerHour = round($avgWagonsPerHour, 1);

        // --- Média toneladas/hora ---
        $avgTonsPerHour = $dockings
            ->filter(fn($d) => $d->hora_inicio_carga && $d->hora_fim_carga && ($d->peso_proprio + $d->peso_terceiros) > 0)
            ->map(fn($d) => $this->ratePerHour($d->hora_inicio_carga, $d->hora_fim_carga, $d->peso_proprio + $d->peso_terceiros))
            ->filter()
            ->avg() ?? 0;
        $avgTonsPerHour = round($avgTonsPerHour, 2);

        // --- Tempos médios ---
        $avgStartDelayMinutes = $this->averageMinutes($dockings, 'hora_encoste', 'hora_inicio_carga');
        $avgLoadingMinutes    = $this->averageMinutes($dockings, 'hora_inicio_carga', 'hora_fim_carga');
        $avgCycleMinutes      = $this->averageMinutes($dockings, 'hora_encoste', 'hora_partida');

        // --- Taxas % ---
        $wagonUtilizationRate = $this->averageRate($dockings, 'qtd_vagoes_carregados', 'qtd_vagoes_total');
        $wagonRefusalRate     = $this->averageRate($dockings, 'qtd_vagoes_recusados', 'qtd_vagoes_total');
        $wagonsOpen           = $this->averageRate($dockings, 'qtd_vagoes_abertos', 'qtd_vagoes_total');

        return [
            // contagens e totais
            'dockingsCount'        => $dockingsCount,
            'coruripeTotal'        => (float) $sumCoruripe,
            'rumoTotal'            => (float) $sumRumo,
            'sumTotal'             => (float) $sumTotal,
            'coruripeTotalFormat'  => number_format($sumCoruripe, 3, ',', '.'),
            'rumoTotalFormat'      => number_format($sumRumo, 3, ',', '.'),
            'pitTotalFormat'       => number_format($sumTotal, 3, ',', '.'),

            // médias e taxas
            'avgTonPerWagon'       => number_format($avgTonPerWagon, 3, ',', '.'),
            'avgWagonsPerHour'     => number_format($avgWagonsPerHour, 1, ',', '.'),
            'avgTonsPerHour'       => number_format($avgTonsPerHour, 3, ',', '.'),
            'wagonUtilizationRate' => $wagonUtilizationRate,
            'wagonRefusalRate'     => $wagonRefusalRate,
            'wagonsOpen'           => $wagonsOpen,

            // tempos
            'avgStartDelay'        => $this->formatMinutes($avgStartDelayMinutes),
            'avgStartDelayMinutes' => round($avgStartDelayMinutes, 1),
            'avgLoadingTime'       => $this->formatMinutes($avgLoadingMinutes),
            'avgLoadingMinutes'    => round($avgLoadingMinutes, 1),
            'avgCycleTime'         => $this->formatMinutes($avgCycleMinutes),
            'avgCycleMinutes'      => round($avgCycleMinutes, 1),

            // safra ativa
            'selectedHarvest'      => $selectedHarvest,
            'harvestMessage'       => null,
        ];
    }

    private function ratePerHour($start, $end, $value): ?float
    {
        $start = $start instanceof Carbon ? $start : Carbon::parse($start);
        $end   = $end instanceof Carbon ? $end : Carbon::parse($end);

        $seconds = $end->getTimestamp() - $start->getTimestamp();
        if ($seconds <= 0) return null;

        $hours = $seconds / 3600.0;
        return $value / $hours;
    }

    private function averageMinutes($dockings, string $startCol, string $endCol): float
    {
        $minutes = $dockings
            ->filter(fn($d) => $d->$startCol && $d->$endCol)
            ->map(function ($d) use ($startCol, $endCol) {
                $start = $d->$startCol instanceof Carbon ? $d->$startCol : Carbon::parse($d->$startCol);
                $end   = $d->$endCol instanceof Carbon ? $d->$endCol : Carbon::parse($d->$endCol);
                $seconds = $end->getTimestamp() - $start->getTimestamp();
                return $seconds > 0 ? $seconds / 60.0 : null;
            })->filter();

        return $minutes->count() ? $minutes->avg() : 0;
    }

    private function averageRate($dockings, string $col, string $totalCol): float
    {
        $rates = $dockings
            ->filter(fn($d) => $d->$totalCol > 0)
            ->map(fn($d) => ($d->$col / $d->$totalCol) * 100);

        return $rates->count() ? round($rates->avg(), 1) : 0;
    }

    private function formatMinutes($minutesFloat): string
    {
        $minutes = (int) round($minutesFloat);
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;
        return sprintf('%02d:%02d', $hours, $mins);
    }

    private function emptyIndicators($selectedHarvest = null, ?string $message = null): array
    {
        return [
            'dockingsCount'        => 0,
            'coruripeTotal'        => 0,
            'rumoTotal'            => 0,
            'sumTotal'             => 0,
            'coruripeTotalFormat'  => '0,000',
            'rumoTotalFormat'      => '0,000',
            'pitTotalFormat'       => '0,000',
            'avgTonPerWagon'       => 0,
            'avgWagonsPerHour'     => 0,
            'avgTonsPerHour'       => 0,
            'wagonUtilizationRate' => 0,
            'wagonRefusalRate'     => 0,
            'wagonsOpen'           => 0,
            'avgStartDelay'        => '00:00',
            'avgStartDelayMinutes' => 0,
            'avgLoadingTime'       => '00:00',
            'avgLoadingMinutes'    => 0,
            'avgCycleTime'         => '00:00',
            'avgCycleMinutes'      => 0,
            'selectedHarvest'      => $selectedHarvest,
            'harvestMessage'       => $message,
        ];
    }
}