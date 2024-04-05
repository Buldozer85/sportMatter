<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'email.required' => 'E-mail musí být vyplněn',
            'email.email' => 'Zadaný email není ve tvaru platné emailové adresy',
            'email.string' => 'E-mail  musí být textový řetězec',
            'password.required' => 'Heslo musí být vyplněno',
            'password.string' => 'Heslo musí být textovým řetězcem'
        ];
    }
}
