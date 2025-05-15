<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['gmail.com', 'googlemail.com'];
                    $domain = explode('@', $value)[1] ?? '';

                    if (!in_array($domain, $allowedDomains)) {
                        $fail('Harus menggunakan email Google (contoh: @gmail.com)yang sudah terdaftar di email google');
                    }
                }
            ],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required', 'accepted'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.function' => 'Harus menggunakan email Google (contoh: @gmail.com) yang sudah terdaftar di email google',
        ];
    }
}
