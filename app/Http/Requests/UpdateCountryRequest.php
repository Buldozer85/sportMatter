<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCountryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('countries', 'name')->ignore($this->country->id)],
            'short_name' => ['required', 'string', Rule::unique('countries', 'short_name')->ignore($this->country->id)]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Jméno sportu je povinné',
            'name.string' => 'Jméno musí být textový řetězec',
            'name.unique' => 'Název musí být jedinečný',
            'short_name.required' => 'Jméno sportu je povinné',
            'short_name.string' => 'Jméno musí být textový řetězec',
            'short_name.unique' => 'Název musí být jedinečný'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
