<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
      public function rules(): array
    {
        $id = $this->route('proveedore')?->id; 
        // OJO: Laravel resource usa "proveedore" si el resource es proveedores

        return [
            'nombre'   => 'required|string|max:100',
            'correo'   => 'nullable|email|max:100|unique:proveedores,correo,' . $id,
            'telefono' => 'nullable|string|max:20',
            'estado'   => 'nullable|boolean'
        ];
    }
}
