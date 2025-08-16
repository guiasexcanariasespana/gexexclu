<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AnuncioCreateAdminRequest extends FormRequest
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
        $user = $this->user;
        return [
            //'nombre' => 'required||unique:anuncios,nombre,user_id,deleted_at,NULL',
            'nombre' => ['required', 'max:50' ],
            'telefono' => ['required', 'min:9', 'max:9'],            
            'orientacion' => 'required',
            'plane_id' => 'required',
            'categoria_id' => 'required',
            'user_id' => 'required',
            //'slug' => 'required|unique:anuncios,slug,NULL,id,deleted_at,NULL',
            //'tipo' => 'required',
            'titulo' => 'required|max:75',
            'provincia_id' => 'required',
            'municipio_id' => 'required',             
            'precio' => 'required',
            'edad' => 'required|numeric|gt:17',
            
        ];
    }
}
