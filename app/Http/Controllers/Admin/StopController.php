<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Docking;
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
        // Busca o docking que será vinculado ao stop
        $docking = Docking::findOrFail($docking);

        return view('pages.stops.create', compact('docking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'docking_id'  => 'required|exists:dockings,id',
            'hora_inicio' => 'required|date',
            'hora_fim'    => 'required|date|after:hora_inicio',
            'motivo'      => 'nullable|string|max:255',
        ]);

        Stop::create([
            'docking_id'     => $request->docking_id,
            'hora_inicio'    => $request->hora_inicio,
            'hora_fim'       => $request->hora_fim,
            'motivo'         => $request->motivo,
            'user_id'        => Auth::id(),
            // não precisa enviar `duracao_minutos`, pois o Model já calcula no booted()
        ]);

        return redirect()
            ->route('dockings.index', $request->docking_id)
            ->with('success', 'Parada registrada com sucesso.');
    }
}
