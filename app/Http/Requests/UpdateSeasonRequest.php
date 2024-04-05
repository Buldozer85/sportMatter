<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeasonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'yearStart' => ['required', 'date'],
            'yearEnd' => ['required', 'date'],
            'league' => ['required', 'integer'],
            'is_active' => ['boolean', 'nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'yearStart.required' => 'Začátek sezóny musí být vyplněn',
            'yearStart.date' => 'Začátek sezóny musí být datum',
            'yearEnd.required' => 'Konec sezóny musí být vyplněn',
            'yearEnd.date' => 'Konec sezóny musí být datum',
            'league.required' => 'Liga je povinná',
            'league.integer' => 'Liga musí být číslo',
            'is_active.boolean' => 'Liga je aktivní musí být 1/0',
        ];
    }
}
