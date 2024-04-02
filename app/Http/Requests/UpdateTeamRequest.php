<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeamRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('teams', 'name')->ignore($this->team->id)],
            'short_name' => ['required', 'string', Rule::unique('teams', 'short_name')->ignore($this->team->id)],
            'stadium' => ['required', 'integer'],
            'league' => ['required', 'integer']
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
            'short_name.unique' => 'Název musí být jedinečný',
            'stadium.required' => 'Stadión musí být vyplněn',
            'stadium.integer' => 'Hodnota stadiónu musí být celé číslo',
            'league.required' => 'Liga musí být vyplněna',
            'league.integer' => 'Hodnota ligy musí být celé číslo',

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
