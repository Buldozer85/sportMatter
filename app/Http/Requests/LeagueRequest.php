<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeagueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'association' => ['required'],
            'name' => ['required'],
            'country' => ['required', 'integer'],
            'sport' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'association.required' => 'Asociace musí být vyplněna',
            'name.required' => 'Název je povinný',
            'country.required' => 'Země musí být vyplněna',
            'country.integer' => 'Země musí být číslo',
            'sport.required' => 'Sport musí být vyplněn',
            'sport.integer' => 'Sport musí být číslo'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
