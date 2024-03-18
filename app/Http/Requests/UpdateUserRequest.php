<?php

namespace App\Http\Requests;

use App\enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'password' => ['required', 'string', 'confirmed'],
            'password_confirmation' => ['required_with:password', 'string'],
            'access' => Rule::in([Role::USER->value, Role::EDITOR->value, Role::ADMINISTRATOR->value, Role::SUPER_ADMINISTRATOR->value])
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Křestní jméno je povinné',
            'first_name.string' => 'Křestní jméno musí být textový řetězec',
            'last_name.required' => 'Příjmení je povinné',
            'last_name.string' => 'Příjmení musí být textový řetězec',
            'email.required' => 'E-mail je povinný',
            'email.string' => 'E-mail musí být textový řetězec',
            'email.unique' => 'Účet s tímto e-mailem již existuje',
            'password.required' => 'Heslo je povinné',
            'password.string' => 'Heslo musí být textový řetězec',
            'password.confirmed' => 'Zadaná hesla se neshodují',
            'password_confirmation.required_with' => 'Heslo znovu musí být vyplněno',
            'password_confirmation.string' => 'Heslo znovu musí být textový řetězec',
            'access.in' => 'Zadaná role neexistuje'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
