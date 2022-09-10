<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class ClientesRequest extends FormRequest
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
            'razon' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'estado' => 'required', 
            'rfc' => 'required',
            'comision' => 'required|numeric', 
            'diarevision' => 'max:10', 
            'diapago' => 'max:10',
            'diascred' => 'required|numeric',
            'tcambio' => 'numeric',
            'ctacliente' => 'max:15',
            'ag_activa' => 'required|numeric',
            'saldo_ini' => 'numeric',
            'notipoc' => 'required|numeric',
            'prec_prop' => 'required|numeric',
            'tienecred' => 'required|numeric',
            'cvexcaret' => 'max:15'
        ];
    }
}
