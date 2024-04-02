<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSeasonRequest extends FormRequest
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

    public function authorize(): bool
    {
        return true;
    }
}
