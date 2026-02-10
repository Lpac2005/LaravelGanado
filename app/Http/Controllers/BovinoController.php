<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BovinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bovinos = \App\Models\Bovino::latest()->get();
        return \Inertia\Inertia::render('Bovinos/Index', [
            'bovinos' => $bovinos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return \Inertia\Inertia::render('Bovinos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'arete' => 'required|string|unique:bovinos,arete|max:255',
            'nombre' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'raza' => 'required|string|max:255',
            'sexo' => 'required|in:Macho,Hembra',
            'peso_nacimiento' => 'nullable|numeric|min:0',
        ]);

        \App\Models\Bovino::create($validated);

        return redirect()->route('bovinos.index');
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
        $bovino = \App\Models\Bovino::findOrFail($id);
        return \Inertia\Inertia::render('Bovinos/Edit', [
            'bovino' => $bovino
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bovino = \App\Models\Bovino::findOrFail($id);

        $validated = $request->validate([
            'arete' => 'required|string|max:255|unique:bovinos,arete,' . $bovino->id,
            'nombre' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'raza' => 'required|string|max:255',
            'sexo' => 'required|in:Macho,Hembra',
            'peso_nacimiento' => 'nullable|numeric|min:0',
        ]);

        $bovino->update($validated);

        return redirect()->route('bovinos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bovino = \App\Models\Bovino::findOrFail($id);
        $bovino->delete();

        return redirect()->route('bovinos.index');
    }
}
