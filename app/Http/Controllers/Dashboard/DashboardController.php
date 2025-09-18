<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Docking;
use App\Models\Admin\Harvest;
use App\Models\User;
use App\Services\DockingIndicatorsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request, DockingIndicatorsService $service)
    {
        $query = Docking::with('port', 'stops.reason');

        // filtros de data (se quiser)
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

        // se o usuário escolheu safra no select:
        $harvestId = $request->input('harvest_id'); // pode ser null
        $harvests = Harvest::all();
        $activeHarvest = Harvest::where('is_active', true)->first();
        $indicators = $service->calculate($query, $harvestId);

        // dd($harvestId);

        return view('pages.dashboard.dashboard', compact('indicators', 'harvests', 'activeHarvest', 'harvestId'));
    }


}