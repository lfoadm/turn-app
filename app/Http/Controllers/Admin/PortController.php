<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Port;
use Illuminate\Http\Request;


class PortController extends Controller
{
    public function index()
    {
        $ports = Port::latest()->get();

        // Transforma em array pronto para o front
        $portsJson = $ports->map(fn($h) => [
            'id'        => $h->id,
            'title'     => $h->title,
            'description' => $h->description,
        ]);

        return view('pages.ports.index', [
            'ports'     => $ports,
            'portsJson' => $portsJson,
        ]);
    }

    public function create()
    {
        return view('pages.ports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Port::create($validated);

        return redirect()->route('ports.index')->with('success', 'Terminal portuário cadastrado com sucesso');
    }

    public function show(Port $port)
    {
        return view('pages.ports.show', compact('port'));
    }

    public function edit(Port $port)
    {
        return view('pages.ports.edit', compact('port'));
    }

    public function update(Request $request, Port $port)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $port->update($validated);

        return redirect()->route('ports.index')->with('success', 'Terminal portuário atualizado com sucesso.');
    }

    public function destroy(Port $port)
    {
        $port->delete();

        return redirect()->route('ports.index')->with('success', 'Terminal portuário apagado.');
    }

    public function painel()
    {
        return view('pages.testes.test');
    }
}
