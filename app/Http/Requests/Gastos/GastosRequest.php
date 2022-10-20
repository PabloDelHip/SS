<?php

namespace App\Http\Requests\Gastos;

use App\Http\Requests\FormRequest;

class GastosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:250',
            'gasto' => 'required|numeric',
            'clave_clientes_tours' => 'required|numeric',
        ];
    }
}
