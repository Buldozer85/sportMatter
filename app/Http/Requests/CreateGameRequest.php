<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGameRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date_of_match' => ['required', 'date'],
            'lap' => ['required', 'integer'],
            'supervisor' => ['required', 'integer'],
            'away_team' => ['required', 'integer'],
            'home_team' => ['required', 'integer'],
            'league' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
