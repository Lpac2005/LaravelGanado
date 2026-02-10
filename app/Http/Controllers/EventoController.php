<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Evento::with('bovino');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('bovino', function($q) use ($search) {
                $q->where('arete', 'like', "%{$search}%")
                  ->orWhere('nombre', 'like', "%{$search}%");
            })->orWhere('tipo', 'like', "%{$search}%");
        }

        $eventos = $query->latest('fecha')->get();

        return \Inertia\Inertia::render('Eventos/Index', [
            'eventos' => $eventos,
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bovinos = \App\Models\Bovino::select('id', 'arete', 'nombre')->get();
        return \Inertia\Inertia::render('Eventos/Create', [
            'bovinos' => $bovinos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bovino_id' => 'required|exists:bovinos,id',
            'tipo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'detalle' => 'nullable|string',
        ]);

        \App\Models\Evento::create($validated);

        return redirect()->route('eventos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evento = \App\Models\Evento::findOrFail($id);
        $bovinos = \App\Models\Bovino::select('id', 'arete', 'nombre')->get();

        return \Inertia\Inertia::render('Eventos/Edit', [
            'evento' => $evento,
            'bovinos' => $bovinos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $evento = \App\Models\Evento::findOrFail($id);

        $validated = $request->validate([
            'bovino_id' => 'required|exists:bovinos,id',
            'tipo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'detalle' => 'nullable|string',
        ]);

        $evento->update($validated);

        return redirect()->route('eventos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evento = \App\Models\Evento::findOrFail($id);
        $evento->delete();

        return redirect()->route('eventos.index');
    }
}
