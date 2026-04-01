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
            // sta se prosledjuje od podataka: email, password, Name, confirmPassword

            'email' => ['required', 'unique:users,email', 'max:50', 'regex: /^[a-zA-Z0-9._%+-]+@gmail\.com$/ '],
            'name' => ['required', 'max:20', 'regex: /^[A-Z][a-z]*$/'], // mora da pocinje velikim Slovom
            'password' => ['required', 'regex: /(?=.*[0-9])(?=.*[^a-zA-Z0-9])[A-Z].{7,}/', 'confirmed']
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email je obavezan.',
            'email.unique' => 'Ovaj email je vec registrovan.',
            'email.max' => 'Email ne sme imati vise od 50 karaktera.',
            'email.regex' => 'Email mora biti u gmail.com formatu i da pre @gmail sadrzi barem neko slovo ili broj.',

            'name.required' => 'Ime je obavezno.',
            'name.max' => 'Ime ne sme imati vise od 20 karaktera.',
            'name.regex' => 'Ime mora poceti velikim slovom i sadrzati samo slova.',

            'password.required' => 'Sifra je obavezna.',
            'password.regex' => 'Sifra mora poceti velikim slovom i sadrzati najmanje 8 karaktera, jedan broj i jedan specijalni znak.',
            'password.confirmed' => 'Potvrda sifre se ne poklapa.',
        ];
    }
}
