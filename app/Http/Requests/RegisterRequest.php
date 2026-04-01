<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            //
            // email treba da bude unique
            // sta se prosledjuje od podataka

            // email, password, Name, confirmPassword
            'email' => ['required', 'unique:users,email', 'max:50', 'regex: /^[a-zA-Z0-9._%+-]+@gmail\.com$/ '],
            'name' => ['required', 'max:20', 'regex: /^[A-Z][a-z]*$/'], // mora da pocinje velikim Slovom
            'password' => ['required', 'regex: /(?=.*[0-9])(?=.*[^a-zA-Z0-9])[A-Z].{7,}/', 'confirmed']
        ];
    }

    public function messages(): array
    {
        return [
            '*' => 'Something went wrong',
        ];
    }
}
