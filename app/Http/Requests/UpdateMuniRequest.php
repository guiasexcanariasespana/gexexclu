<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMuniRequest extends FormRequest
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
            'nombre' => 'required|unique:municipios,nombre,'. $this->municipio->id .',id,deleted_at,NULL',
            'slug' => 'required|unique:municipios,slug,' . $this->municipio->id . ',id,deleted_at,NULL',
            'provincia_id' => 'required',
            'title' => 'required|min:10|max:75',
            'keywords' => 'required|',
            'description' => 'required|min:100|max:175',
        ];
    }
}
