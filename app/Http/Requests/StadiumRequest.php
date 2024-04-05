<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StadiumRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'capacity' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Název stadionu musí být vyplněn',
            'name.string' => 'Název musí být textový řetězec',
            'capacity.required' => 'Kapacita musí být vyplněna',
            'capacity.integer' => 'Kapacita musí být celé číslo'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
