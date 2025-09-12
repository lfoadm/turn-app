<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StopRequest;
use App\Models\Admin\Docking;
use App\Models\Admin\Reason;
use App\Models\Admin\Stop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StopController extends Controller
{
    public function index()
    {
        $stops = Stop::orderBy('id', 'DESC')->get();
        return view('pages.stops.index', compact('stops'));
    }

    public function create($docking)
    {
        $reasons = Reason::all();
        $docking = Docking::findOrFail($docking);

        return view('pages.stops.create', compact('docking', 'reasons'));
    }

    public function store(StopRequest $request)
    {
        Stop::create([
            'docking_id'     => $request->docking_id,
            'reason_id'      => $request->reason_id,
            'hora_inicio'    => $request->hora_inicio,
            'hora_fim'       => $request->hora_fim,
            'user_id'        => Auth::id(),
            // não precisa enviar `duracao_minutos`, pois o Model já calcula no booted()
        ]);

        return redirect()
            ->route('dockings.index', $request->docking_id)
            ->with('success', 'Parada registrada com sucesso.');
    }
}
