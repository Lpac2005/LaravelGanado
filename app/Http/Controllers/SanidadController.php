<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanidads = \App\Models\Sanidad::with('bovino')->latest('fecha_aplicacion')->get();
        return \Inertia\Inertia::render('Sanidads/Index', [
            'sanidads' => $sanidads
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bovinos = \App\Models\Bovino::select('id', 'arete', 'nombre')->get();
        return \Inertia\Inertia::render('Sanidads/Create', [
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
            'producto' => 'required|string|max:255',
            'fecha_aplicacion' => 'required|date',
            'proxima_dosis' => 'nullable|date|after:fecha_aplicacion',
            'costo' => 'nullable|numeric|min:0',
            'notas' => 'nullable|string',
        ]);

        \App\Models\Sanidad::create($validated);

        return redirect()->route('sanidads.index');
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
        $sanidad = \App\Models\Sanidad::findOrFail($id);
        $bovinos = \App\Models\Bovino::select('id', 'arete', 'nombre')->get();

        return \Inertia\Inertia::render('Sanidads/Edit', [
            'sanidad' => $sanidad,
            'bovinos' => $bovinos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sanidad = \App\Models\Sanidad::findOrFail($id);

        $validated = $request->validate([
            'bovino_id' => 'required|exists:bovinos,id',
            'tipo' => 'required|string|max:255',
            'producto' => 'required|string|max:255',
            'fecha_aplicacion' => 'required|date',
            'proxima_dosis' => 'nullable|date|after:fecha_aplicacion',
            'costo' => 'nullable|numeric|min:0',
            'notas' => 'nullable|string',
        ]);

        $sanidad->update($validated);

        return redirect()->route('sanidads.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sanidad = \App\Models\Sanidad::findOrFail($id);
        $sanidad->delete();

        return redirect()->route('sanidads.index');
    }
}
