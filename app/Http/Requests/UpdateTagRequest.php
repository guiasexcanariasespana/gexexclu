<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
            'nombre' => ['required', 'max:50', Rule::unique('tags')->where(fn ($query) => $query->where('rubro', $this->rubro)->where('id', $this->id)->whereNull('deleted_at'))],
            'slug' => 'required',
            'color' => 'required',
            'visible' => 'required',
            'menu' => 'required',
        ];
    }
}
