<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    // 1. Definimos el nombre de la tabla (opcional si es el plural en inglés, pero seguro por tu imagen)
    protected $table = 'productos';

    // 2. Campos que se pueden llenar desde un formulario
    protected $fillable = [
    'nombre', 
    'color', 
    'talla', 
    'precio_compra', 
    'precio_venta', 
    'stock_minimo', // Asegúrate de que el nombre sea igual a tu imagen
    'estado',
    'categoria_id'
];

    // 3. Relación: Un producto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

}
