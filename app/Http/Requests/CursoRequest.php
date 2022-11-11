<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
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
            'instructor' => 'required|max:50|min:2',
            'categoria' => 'required|max:50|min:2',
            'duracion' => 'required|max:50|min:2',
            'titulo' => 'required|max:50|min:2',
            'descripcion' => 'required|min:2',
            'precio' => 'required|min:1'    
        ];
    }
}
