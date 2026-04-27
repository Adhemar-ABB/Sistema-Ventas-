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

        $productos = Producto::with('categoria')->where('estado', 1)->get();
        $categorias = Categoria::all();

        return view('productos.index', compact('productos', 'categorias'));
    }
    
    

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'precio_venta' => 'required|numeric',
            'precio_compra' => 'required|numeric',
            'stock_minimo' => 'required|integer', // Coincide con tu DB
            'color' => 'required',
            'talla' => 'required',
        ]);

        try {
            $producto = new Producto();
            $producto->fill($request->all());
            $producto->estado = 1; 
            // Si no tienes categoria_id en el formulario, dale uno por defecto o hazlo nullable en DB
            $producto->categoria_id = $request->categoria_id ?? 1; 
            
            $producto->save();

            return redirect()->route('producto.index')->with('success', 'Guardado!');
        } catch (\Exception $e) {
            // Esto te dirá exactamente qué falló (ej: columna no encontrada)
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function destroy($id)
        {
            try {
                $producto = Producto::findOrFail($id);

                // Cambiar el estado del producto a 'Inactivo' (0)
                $producto->estado = 0; // Cambiar a inactivo
                $producto->save(); // Guardar el cambio

                // Responder con un mensaje de éxito
                return response()->json([
                    'success' => true,
                    'mensaje' => 'Producto eliminado correctamente.'
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'No se pudo procesar la acción.'
                ]);
            }
        }

        public function update(Request $request, $id)
        {
            try {
                // Buscar el producto por su ID
                $producto = Producto::findOrFail($id);

                // Validar los datos recibidos
                $request->validate([
                    'nombre' => 'required|max:255',
                    'precio_venta' => 'required|numeric',
                    'precio_compra' => 'required|numeric',
                    'stock_minimo' => 'required|integer',
                    'color' => 'required',
                    'talla' => 'required',
                ]);

                // Actualizar el producto con los datos del formulario
                $producto->update($request->all());

                // Redirigir con mensaje de éxito
                return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
            } catch (\Exception $e) {
                // Si ocurre un error
                return redirect()->back()->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
            }
        }
}
