<?php

namespace App\Http\Requests\Guias;

use App\Http\Requests\FormRequest;
use App\Rules\numberPhone;

class GuiaCreateRequest extends FormRequest
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
            'nombre' => 'required|max:40',
            'idiomas' => 'max:70',
            'direccion' => 'max:50',
            'telefono' => ['max:25', new numberPhone],
            'honorarios' => 'numeric', 
            'aborde' => 'max:5',
        ];
    }
}
