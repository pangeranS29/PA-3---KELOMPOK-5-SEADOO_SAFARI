<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DetailPaketRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'paket_jetski_id'   => 'required|exists:paket_jetski,id',
            'harga'             => 'required|numeric|min:0',
            'deskripsi'         => 'required|string',
            'jumlah_jetski'     => 'required|integer|min:0',
            'harga_drone'       => 'nullable|numeric|min:0',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048', // foto opsional saat update
        ];
    }
}
