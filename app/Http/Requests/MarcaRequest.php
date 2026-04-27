<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
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
        $id = $this->marca?->id;

        return [
            'nombre'      => 'required|string|max:100|unique:marcas,nombre,' . $id,
            'descripcion' => 'nullable|string|max:255',
            'estado'      => 'nullable|boolean',
        ];
    }
}
