<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:sports']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Jméno sportu je povinné',
            'name.string' => 'Jméno musí být textový řetězec',
            'name.unique' => 'Název musí být jedinečný'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
