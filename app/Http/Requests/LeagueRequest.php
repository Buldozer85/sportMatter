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

    public function authorize(): bool
    {
        return true;
    }
}
