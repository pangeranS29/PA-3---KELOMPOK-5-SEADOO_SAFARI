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
            'paket_jetski_id' => 'required|exists:paket_jetski,id',
            'foto' => 'required|array',
            'foto.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:5048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'deskripsi' => 'nullable|string',
            'jumlah_penumpang' => 'nullable|integer|min:0',
        ];
    }

}
