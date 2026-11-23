<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Ambil ID media dari URL (misal /api/media/1)
        $mediaId = $this->route('media');

        return [
            // unique:media,judul,ID_YANG_DIKECUALIKAN
            'judul' => 'required|string|max:255|unique:media,judul,' . $mediaId,
            'jenis' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
        ];
    }

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
