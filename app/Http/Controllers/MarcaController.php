<?php

namespace App\Http\Controllers;


use App\Models\Marca;
use App\Http\Requests\MarcaRequest;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{;
    $marcas = Marca::all();
    return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }
    /**
     * Store a newly created resource in storage.
     */
   public function store(MarcaRequest $request)
    {
        Marca::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado'      => 1
        ]);

        return redirect()->route('marcas.index')
            ->with('success', 'Marca registrada correctamente');
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
   public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaRequest $request, Marca $marca)
    {
        $marca->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado'      => $request->estado ?? 1
        ]);

        return redirect()->route('marcas.index')
            ->with('success', 'Marca actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
      public function destroy(Marca $marca)
    {
        $marca->update([
            'estado' => 0
        ]);

        return redirect()->route('marcas.index')
            ->with('success', 'Marca desactivada correctamente');
    }
}
