<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Reason;
use Illuminate\Http\Request;

class ReasonController extends Controller
{
    public function index()
    {
        $reasons = Reason::orderBy('title', 'asc')->get();
        return view('pages.reasons.index', compact('reasons'));
    }

    public function create()
    {
        return view('pages.reasons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'purge' => 'boolean|required',
        ]);

        Reason::create($validated);

        return redirect()->route('reasons.index')->with('success', 'Motivo cadastrado com sucesso');
    }

    public function edit(Reason $reason)
    {
        return view('pages.reasons.edit', compact('reason'));
    }

    public function update(Request $request, Reason $reason)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'purge' => 'boolean|required',
        ]);

        $reason->update($validated);
        return redirect()->route('reasons.index')->with('success', 'Motivo atualizado com sucesso.');
    }

    public function destroy(Reason $reason)
    {
        $reason->delete();

        return redirect()->route('reasons.index')->with('success', 'Motivo apagado.');
    }
}
