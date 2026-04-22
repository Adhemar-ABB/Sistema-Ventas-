<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    $clientes = Cliente::all();
    return view('clientes.index', compact('clientes'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(ClienteRequest $request)
    {
        Cliente::create([
            'nombre_completo' => $request->nombre_completo,
            'telefono'        => $request->telefono,
            'correo'          => $request->correo,
            'carnet'          => $request->carnet,
            'estado'          => $request->estado ?? 1,
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente registrado correctamente');
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
   public function edit(Cliente $cliente)
{
    return view('clientes.edit', compact('cliente'));
}



    /**
     * Update the specified resource in storage.
     */
   public function update(ClienteRequest $request, Cliente $cliente)
{
    $cliente->update([
        'nombre_completo' => $request->nombre_completo,
        'telefono'        => $request->telefono,
        'correo'          => $request->correo,
        'carnet'          => $request->carnet,
        'estado'          => $request->estado ?? 1,
    ]);

    return redirect()->route('clientes.index')
        ->with('success', 'Cliente actualizado correctamente');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Cliente $cliente)
{
    $cliente->delete();

    return redirect()->route('clientes.index')
        ->with('success', 'Cliente eliminado correctamente');
}
}
