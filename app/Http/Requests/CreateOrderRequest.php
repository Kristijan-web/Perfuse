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
}
