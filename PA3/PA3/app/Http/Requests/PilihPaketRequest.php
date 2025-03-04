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
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
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
            'nama_paket.required' => 'Judul paket wajib diisi.',
            'nama_paket.max' => 'Judul paket tidak boleh lebih dari 255 karakter.',
            'harga.required' => 'Harga paket wajib diisi.',
            'harga.integer' => 'Harga paket harus berupa angka.',
            'harga.min' => 'Harga paket tidak boleh kurang dari 0.',
            'deskripsi.string' => 'Deskripsi paket harus berupa teks.',
            'stok.required' => 'stok paket wajib diisi.',
            'stok.integer' => 'stok paket harus berupa angka.',
        ];
    }
}
