<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'gender' => ['required', 'string', 'in:muski,zenski'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'water_type_id' => ['required', 'integer', 'exists:water_types,id'],
            'discount' => ['nullable', 'integer', 'exists:discounts,id'],
            'mls' => ['required'],
            'images' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Naziv proizvoda je obavezan.',
            'title.string' => 'Naziv proizvoda mora biti tekst.',
            'title.max' => 'Naziv proizvoda ne sme imati vise od 255 karaktera.',

            'price.required' => 'Cena proizvoda je obavezna.',
            'price.integer' => 'Cena proizvoda mora biti ceo broj.',
            'price.min' => 'Cena proizvoda ne sme biti manja od 0.',

            'gender.required' => 'Pol je obavezan.',
            'gender.string' => 'Pol mora biti tekst.',
            'gender.in' => 'Pol mora biti muski ili zenski.',

            'brand_id.required' => 'Brend je obavezan.',
            'brand_id.integer' => 'Brend mora biti ispravan broj.',
            'brand_id.exists' => 'Izabrani brend ne postoji.',

            'water_type_id.required' => 'Tip vode je obavezan.',
            'water_type_id.integer' => 'Tip vode mora biti ispravan broj.',
            'water_type_id.exists' => 'Izabrani tip vode ne postoji.',

            'discount.integer' => 'Popust mora biti ispravan broj.',
            'discount.exists' => 'Izabrani popust ne postoji.',

            'images.required' => "Slika je obavezna"
        ];

    }
}


