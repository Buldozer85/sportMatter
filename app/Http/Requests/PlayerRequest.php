<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'birthdate' => ['required', 'date'],
            'country' => ['required', 'integer'],
            'team' => ['required', 'integer'],
        ];
    }

    public function messages()
    {
        return [
          'first_name.required' => 'Jméno musí být vyplněno',
          'last_name.required' => 'Příjmení musí být vyplněno',
          'birthdate.required' => 'Datum narození je povinné',
          'birthdate.date' => 'Datun narození musí být datum',
          'country.required' => 'Země musí být vyplněna',
          'country.integer' => 'Země musí být číslo',
          'team.required' => 'Tým musí být vyplněn',
          'team.integer' => 'Tým musí být číslo'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
