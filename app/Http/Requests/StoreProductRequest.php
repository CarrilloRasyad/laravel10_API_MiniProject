<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'name' => ['required'],
            'merk' => ['required'],
            'jasa_pengiriman' => ['required', 'string', Rule::in(['jne', 'jnt', 'sicepat'])],
            'berat' => ['required', 'integer'],
            'alamat' => ['required'],
            'qty' => ['required', 'integer'],
            'harga' => ['required', 'integer'],
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Nama product wajib di isi',
            'merk.required' => 'Merk product wajib di isi',
            'jasa_pengiriman.required' => 'Jasa Pengiriman wajib di isi',
            'jasa_pengiriman.in' => 'Silahkan pilih jasa pengiriman yang sudah di sediakan',
            'berat.required' => 'Berat product wajib di isi',
            'alamat.required' => 'Alamat wajib di isi',
            'qty.required' => 'Quantity wajib di isi',
            'harga.required' => 'Harga wajib di isi',
        ];
    }
}
