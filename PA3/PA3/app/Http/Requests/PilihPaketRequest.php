<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PilihPaketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul paket wajib diisi.',
            'title.max' => 'Judul paket tidak boleh lebih dari 255 karakter.',
            'price.required' => 'Harga paket wajib diisi.',
            'price.integer' => 'Harga paket harus berupa angka.',
            'price.min' => 'Harga paket tidak boleh kurang dari 0.',
            'deskripsi.string' => 'Deskripsi paket harus berupa teks.',
        ];
    }
}
