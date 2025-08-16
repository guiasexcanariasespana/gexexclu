<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProvinciaRequest extends FormRequest
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
            'nombre' => 'required|unique:provincias,nombre,'. $this->provincia->id .',id,deleted_at,NULL',
            'slug' => 'required|unique:provincias,slug,'. $this->provincia->id .',id,deleted_at,NULL',
            'title' => 'required|min:10|max:75',
            'keywords' => 'required|',
            'description' => 'required|min:100|max:175',
        ];
    }
}
