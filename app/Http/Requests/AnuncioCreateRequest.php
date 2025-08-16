<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AnuncioCreateRequest extends FormRequest
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
        $user = Auth()->user();

        return [
            //'nombre' => 'required||unique:anuncios,nombre,user_id,deleted_at,NULL',
            'nombre' => ['required', 'max:50'],
            'titulo' => 'max:75',
            'orientacion' => 'required',
            'plane_id' => 'required',
            'provincia_id' => 'required',
            'municipio_id' => 'required',             
            'categoria_id' => 'required',
            'edad' => 'required|numeric|gt:17',
        ];
    }
}
