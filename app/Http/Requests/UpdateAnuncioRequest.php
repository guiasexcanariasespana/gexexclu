<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAnuncioRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'nombre' => ['required', 'max:50'],
            'telefono' => ['required', 'min:9', 'max:9'],            
            'slug' => 'required|unique:anuncios,slug,' . $this->anuncio->id . ',id,deleted_at,NULL',
            //'tipo' => 'required',
            'titulo' => 'required|max:75',
            'orientacion' => 'required',
            'plane_id' => 'required', 
            'provincia_id'=> 'required',
            'municipio_id' => 'required',     
            'precio' => 'required',
            'edad' => 'required|numeric|gt:17',

        ];
    }
}
