<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Muestra el listado de productos y carga las categorías para el modal.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        $categorias = Categoria::all();
        return view('productos.index', compact('productos', 'categorias'));
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|max:255',
            'precio_venta' => 'required|numeric|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'stock_minimo' => 'nullable|integer',
        ]);

        try {
            $producto = new Producto();
            $producto->fill($request->all());
            $producto->estado = 'Activo'; // Valor por defecto según tu estructura
            $producto->save();

            return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    /**
     * Actualiza un producto existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|max:255',
            'precio_venta' => 'required|numeric|min:0',
            'precio_compra' => 'required|numeric|min:0',
        ]);

        try {
            $producto = Producto::findOrFail($id);
            $producto->update($request->all());

            return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar.');
        }
    }

    /**
     * Elimina el producto o cambia su estado.
     */
    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            
            // Si prefieres borrado lógico (cambiar estado)
            if ($producto->estado == 'Activo') {
                $producto->estado = 'Inactivo';
            } else {
                $producto->estado = 'Activo';
            }
            
            $producto->save();
            
            // O si prefieres eliminarlo por completo:
            // $producto->delete();

            return redirect()->route('productos.index')->with('success', 'Estado del producto actualizado.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'No se pudo procesar la acción.');
        }
    }
}
