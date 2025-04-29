<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'name_customer.required' => 'Nama pelanggan wajib diisi.',
        'name_customer.max' => 'Nama pelanggan tidak boleh lebih dari 255 karakter.',
        'no_telepon.required' => 'Nomor telepon wajib diisi.',
        'no_telepon.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',
        'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
        'waktu_mulai.date' => 'Format waktu mulai tidak valid.',
        'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
        'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
        'total_price.required' => 'Total harga wajib diisi.',
        'total_price.numeric' => 'Total harga harus berupa angka.',
        'total_price.min' => 'Total harga tidak boleh negatif.',
        'detail_paket_id.required' => 'Detail paket wajib dipilih.',
        'detail_paket_id.exists' => 'Detail paket yang dipilih tidak valid.',
        'users_id.required' => 'Pengguna wajib dipilih.',
        'users_id.exists' => 'Pengguna yang dipilih tidak valid.',
        'jumlah_penumpang.integer' => 'Jumlah penumpang harus berupa angka bulat.',
        'jumlah_penumpang.min' => 'Jumlah penumpang minimal adalah 1.',
        ];
    }
}
