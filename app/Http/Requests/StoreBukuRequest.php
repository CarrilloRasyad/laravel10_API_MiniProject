<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBukuRequest extends FormRequest
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
            'nama_buku' => ['required', 'string'],
            'judul' => ['required'],
            'pengarang' => ['required', 'string'],
            'tanggal_publikasi' => ['required']
        ];
    }

    public function messages() 
    {
        return [
            'nama_buku.required' => 'Nama buku wajib di isi',
            'judul.required' => 'Judul buku wajib di isi',
            'pengarang.required' => 'Nama pengarang wajib di isi',
            'tanggal_publikasi.required' => 'Tanggal publikasi wajib di isi'
        ];
    }
}
