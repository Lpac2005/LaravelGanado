<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargamos los pesajes con la información del bovino asociado
        $pesajes = \App\Models\Pesaje::with('bovino')->latest('fecha')->get();
        return \Inertia\Inertia::render('Pesajes/Index', [
            'pesajes' => $pesajes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Necesitamos la lista de bovinos para seleccionarlos en el formulario
        $bovinos = \App\Models\Bovino::select('id', 'arete', 'nombre')->get();
        return \Inertia\Inertia::render('Pesajes/Create', [
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
            'fecha' => 'required|date',
            'peso' => 'required|numeric|min:0',
            'notas' => 'nullable|string',
        ]);

        \App\Models\Pesaje::create($validated);

        return redirect()->route('pesajes.index');
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
        $pesaje = \App\Models\Pesaje::findOrFail($id);
        $bovinos = \App\Models\Bovino::select('id', 'arete', 'nombre')->get();

        return \Inertia\Inertia::render('Pesajes/Edit', [
            'pesaje' => $pesaje,
            'bovinos' => $bovinos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pesaje = \App\Models\Pesaje::findOrFail($id);

        $validated = $request->validate([
            'bovino_id' => 'required|exists:bovinos,id',
            'fecha' => 'required|date',
            'peso' => 'required|numeric|min:0',
            'notas' => 'nullable|string',
        ]);

        $pesaje->update($validated);

        return redirect()->route('pesajes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pesaje = \App\Models\Pesaje::findOrFail($id);
        $pesaje->delete();

        return redirect()->route('pesajes.index');
    }
}
