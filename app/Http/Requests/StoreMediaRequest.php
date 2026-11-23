<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    // Mengizinkan request untuk diproses
    public function authorize(): bool
    {
        return true;
    }

    // Aturan validasi saat membuat media baru
    public function rules(): array
    {
        return [
            // 'required': wajib diisi
            // 'unique:media,judul': tidak boleh ada judul yang sama di tabel media
            'judul' => 'required|string|max:255|unique:media,judul',
            'jenis' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
        ];
    }

    // (Opsional) Kustomisasi pesan error agar lebih rapi dalam bahasa Indonesia
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul media wajib diisi.',
            'judul.unique' => 'Judul media ini sudah ada di database.',
            'jenis.required' => 'Jenis media wajib diisi.',
            'genre.required' => 'Genre media wajib diisi.',
        ];
    }
}
