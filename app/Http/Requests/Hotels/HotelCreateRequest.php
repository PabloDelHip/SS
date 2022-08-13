<?php

namespace App\Http\Requests\Hotels;

use App\Http\Requests\FormRequest;

class HotelCreateRequest extends FormRequest
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
            'nombre' => 'required|max:30',
            'direccion' => 'max:40|max:40',
            'ciudad' => 'required|max:20',
            'estado' => 'required|max:20',
            'telefonos' => 'max:25',
            'zona' => 'required|numeric',
            'orden' => 'numeric',
            'contacto' => 'max:30',
            'pickfijo' => 'max:5',
            'cvehotxc' => 'max:10',
        ];
    }

    // public function messages() {
    //     return [
    //         'email.required' => 'El :attribute es obligatorio',
    //         'email.email' => 'El :attribute debe ser un email',
    //         'pasword.required' => 'La :attribute es obligatoria'
    //     ];
    // }
}
