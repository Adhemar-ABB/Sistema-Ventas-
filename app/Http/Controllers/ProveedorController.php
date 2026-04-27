<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProveedorRequest;

use App\Models\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
    
        $proveedores= Proveedor::all();
    return view('proveedores.index', compact('proveedores'));
    
    
    }

    /**
     * Show the form for creating a new resource.
     */
  public function create()
    {
        return view('proveedores.create');
    }


    /**
     * Store a newly created resource in storage.
     */
      public function store(ProveedorRequest $request)
    {
        Proveedor::create([
            'nombre'   => $request->nombre,
            'correo'   => $request->correo,
            'telefono' => $request->telefono,
            'estado'   => 1,
        ]);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor registrado correctamente');
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
   public function edit(Proveedor $proveedore)
    {
        return view('proveedores.edit', ['proveedor' => $proveedore]);
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(ProveedorRequest $request, Proveedor $proveedore)
    {
        $proveedore->update([
            'nombre'   => $request->nombre,
            'correo'   => $request->correo,
            'telefono' => $request->telefono,
            'estado'   => $request->estado ?? 1,
        ]);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
      public function destroy(Proveedor $proveedore)
    {
        $proveedore->update([
            'estado' => 0
        ]);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor desactivado correctamente');
    }
}
