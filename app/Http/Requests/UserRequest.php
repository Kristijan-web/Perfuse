<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ime je obavezno.',
            'name.string' => 'Ime mora biti tekst.',
            'name.max' => 'Ime ne sme imati vise od 255 karaktera.',

            'email.required' => 'Email je obavezan.',
            'email.string' => 'Email mora biti tekst.',
            'email.email' => 'Email mora biti u ispravnom formatu.',
            'email.max' => 'Email ne sme imati vise od 255 karaktera.',
            'email.unique' => 'Ovaj email je vec registrovan.',

            'password.required' => 'Sifra je obavezna.',
            'password.string' => 'Sifra mora biti tekst.',
            'password.max' => 'Sifra ne sme imati vise od 255 karaktera.',

        ];
    }
}
