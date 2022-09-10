<?php

namespace App\Http\Requests\ClientsTours;

use App\Http\Requests\FormRequest;

class ClientTourCreateRequest extends FormRequest
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
            'clave_tour' => 'required|numeric',
            'clave_cliente' => 'required|numeric',
            'descripcion' => 'max:400',
            'tipo_cambio' => 'required',
            'precio' => 'required|numeric',
            'porcentaje' => 'required|numeric',
            'ganancia' => 'required|numeric',
        ];
    }
}
