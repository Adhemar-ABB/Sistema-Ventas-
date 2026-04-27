<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre_completo',
        'telefono',
        'correo',
        'carnet',
        'estado'
    ];
}