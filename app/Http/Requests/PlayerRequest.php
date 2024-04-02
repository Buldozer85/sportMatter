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

    public function authorize(): bool
    {
        return true;
    }
}
