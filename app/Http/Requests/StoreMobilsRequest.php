<?php

namespace App\Http\Requests;

use App\Enums\JenisMobil;
use App\Enums\Merk;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreMobilsRequest extends FormRequest
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
            'jenis_mobil' => ['required', new Enum(JenisMobil::class)],
            'nama_mobil' => ['required'],
            'merk' => ['required', new Enum(Merk::class)],
            'nopol' => ['required'],
            'harga' => ['required']
        ];
    }

    public function messages() {
        return [
            'jenis_mobil.required' => 'Jenis mobil wajib di isi',
            'jenis_mobil.enum' => 'Silahkan pilih jenis mobil yang sudah di sediakan',
            'nama_mobil.required' => 'Nama mobil wajib di isi',
            'merk.required' => 'Merk mobil wajib di isi',
            'merk.enum' => 'Silahkan pilih merk mobil yang sudah di sediakan',
            'nopol.required' => 'Nomor polisi wajib di isi',
            'harga.required' => 'Harga wajib di isi'
        ];
    }
}
