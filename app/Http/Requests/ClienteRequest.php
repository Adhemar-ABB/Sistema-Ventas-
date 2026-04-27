<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
    $id = $this->route('cliente')?->id;

    return [
        'nombre_completo' => 'required|string|max:100',
        'telefono'        => 'nullable|string|max:20',
        'correo'          => 'nullable|email|max:100|unique:clientes,correo,' . $id,
        'carnet'          => 'required|string|max:20|unique:clientes,carnet,' . $id,
        'estado'          => 'nullable|boolean'
    ];
}
}
