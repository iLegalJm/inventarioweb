<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $producto = $this->route()->parameter('producto');

        /* La matriz `` define las reglas de validación para los campos del formulario en la
        clase `ProductoRequest`. */
        $rules = [
            /* Con la validacion de esa forma evitamos que al editar diga que el nombre ya existe en la base de datos */
            'nombre' => 'required|unique:productos',
            'codigo' => 'required|unique:productos',
            'imagen[]' => 'image'
        ];

        if ($producto) {
            $rules['nombre'] = 'required|unique:productos,nombre,' . $producto->id;
            $rules['codigo'] = 'required|unique:productos,codigo,' . $producto->id;
        }

        return $rules;
    }
}