<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'max:255'],
            'adress' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'postal_code' => ['required', 'max:255'],
            'note' => ['nullable'],
            'total_price' => ['required'],
            'total_quantity' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ime je obavezno.',
            'name.max' => 'Ime ne sme imati vise od 255 karaktera.',

            'lastname.required' => 'Prezime je obavezno.',
            'lastname.max' => 'Prezime ne sme imati vise od 255 karaktera.',

            'email.required' => 'Email je obavezan.',
            'email.email' => 'Email mora biti u ispravnom formatu.',
            'email.max' => 'Email ne sme imati vise od 255 karaktera.',

            'phone_number.required' => 'Broj telefona je obavezan.',
            'phone_number.max' => 'Broj telefona ne sme imati vise od 255 karaktera.',

            'adress.required' => 'Adresa je obavezna.',
            'adress.max' => 'Adresa ne sme imati vise od 255 karaktera.',

            'city.required' => 'Grad je obavezan.',
            'city.max' => 'Grad ne sme imati vise od 255 karaktera.',

            'postal_code.required' => 'Postanski broj je obavezan.',
            'postal_code.max' => 'Postanski broj ne sme imati vise od 255 karaktera.',

            'total_price.required' => 'Ukupna cena je obavezna.',
            'total_quantity.required' => 'Ukupna kolicina je obavezna.',
        ];
    }
}
