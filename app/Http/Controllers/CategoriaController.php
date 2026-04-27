<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(CategoriaRequest $request)
    {
        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado ?? 1,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría registrada correctamente');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado ?? 1,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente');
    }

   /* public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada correctamente');
    }*/


            public function destroy(Categoria $categoria)
{
    $categoria->update([
        'estado' => 0
    ]);

    return redirect()->route('categorias.index')
        ->with('success', 'Categoría desactivada correctamente');
}
}
