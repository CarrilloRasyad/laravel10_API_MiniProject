<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'merk' => ['required', 'string'],
            'jasa_pengiriman' => ['required','string', Rule::in(['jne', 'jnt', 'sicepat'])],
            'berat' => ['required', 'integer', 'min:0'],
            'alamat' => ['required', 'string'],
            'qty' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'integer', 'min:0']
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'Nama product wajib di isi',
            'name.string' => 'Nama harus string',
            'merk.required' => 'Merk product wajib di isi',
            'merk.string' => 'Merk harus string',
            'jasa_pengiriman.required' => 'Jasa Pengiriman wajib di isi',
            'jasa_pengiriman.in' => 'Silahkan pilih jasa pengiriman yang sudah di sediakan',
            'berat.required' => 'Berat product wajib di isi',
            'berat.integer' => 'Berat harus integer',
            'alamat.required' => 'Alamat wajib di isi',
            'qty.required' => 'Quantity wajib di isi',
            'qty.integer' => 'Quantity harus integer',
            'harga.required' => 'Harga wajib di isi',
            'harga.integer' => 'Harga harus integer'
        ];
    }

    public function failedValidation(Validator $validaton)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'Error',
            'message' => 'Failed to update products',
            'error' => $validaton->errors()
        ], 400));
    }
}
