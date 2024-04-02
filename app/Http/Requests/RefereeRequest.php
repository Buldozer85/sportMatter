<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefereeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'sport' => ['integer', 'required']
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Jméno je povinné',
            'first_name.string' => 'Jméno musí být textový řetězec',
            'last_name.required' => 'Příjmení je povinný údaj',
            'last_name.string' => 'Příjmení musí být textový řetěezec',
            'sport.required' => 'Sport musí být vyplněn',
            'sport.integer' => 'Sport musí být číslo'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
