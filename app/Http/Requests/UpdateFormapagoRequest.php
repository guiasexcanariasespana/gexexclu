<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormapagoRequest extends FormRequest
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
            'nombre' => 'required|unique:formapagos,nombre,'. $this->formapago->id .',id,deleted_at,NULL',
            'slug' => 'required|unique:formapagos,slug,'. $this->formapago->id .',id,deleted_at,NULL',
        ];
    }
}
