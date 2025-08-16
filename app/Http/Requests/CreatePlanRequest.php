<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePlanRequest extends FormRequest
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
            'nombre' => ['required', 'max:50', Rule::unique('planes')->where(fn ($query) => $query->where('categoria_id', $this->categoria_id)->whereNull('deleted_at'))],
            'slug' => 'required',
            'dias' => 'required',
            'categoria_id' => 'required',
        ];
    }
}
