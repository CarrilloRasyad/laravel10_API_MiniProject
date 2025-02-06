<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMotorRequest extends FormRequest
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
            'nama' => ['required'],
            'merk' => ['required', 'string', Rule::in(['Honda', 'Kawasaki', 'Ducati'])],
            'harga' => ['required'],
            'jenis' => ['required', 'string', Rule::in(['250cc', '500cc', '1000cc'])],
            'kecepatan' => ['required'],

        ];
    }

    public function messages() 
    {
        return [
            'nama.required' => 'Nama motor wajib di isi',
            'merk.required' => 'Merk motor wajib di isi',
            'merk.in' => 'Silahkan pilih merk motor yang sudah di sediakan',
            'harga.required' => 'Harga motor wajib di isi',
            'jenis.required' => 'Jenis motor wajib di isi',
            'jenis.in' => 'Silahkan pilih jenis motor yang sudah di sediakan',
            'kecepatan.required' => 'Kecepatan motor wajib di isi'
        ];
    }
}
