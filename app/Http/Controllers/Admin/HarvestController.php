<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Harvest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HarvestController extends Controller
{
    use AuthorizesRequests;
    
    public function __construct()
    {
        $this->authorize('viewAny', User::class);
    }

    public function index()
    {

        $harvests = Harvest::latest()->paginate(9);
        return view('pages.harvests.index', compact('harvests'));
    }

    public function create()
    {
        return view('pages.harvests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'is_active' => 'boolean|required',
        ]);

        Harvest::create($validated);

        return redirect()->route('harvests.index')->with('success', 'Safra cadastrada com sucesso');
    }

    public function show(Harvest $harvest)
    {
        return view('pages.harvests.show', compact('harvest'));
    }

    public function edit(Harvest $harvest)
    {
        return view('pages.harvests.edit', compact('harvest'));
    }

    public function update(Request $request, Harvest $harvest)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'is_active' => 'boolean|required',
        ]);

        $harvest->update($validated);

        return redirect()->route('harvests.index')->with('success', 'Safra atualizada com sucesso.');
    }
}
