<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends StoreOrderRequest 
{
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
            'alamat'=> ['required', 'string'],
            'jasa_pengiriman'=> ['required', 'string', Rule::in(['jne', 'jnt', 'sicepat'])],
            'qty'=> ['required', 'integer'],
            'harga'=> ['required', 'numeric'],
        ];
    }

    public function messages(): array {
        return [
            'name.required'=> 'Nama wajib di isi',
            'alamat.required' => 'Alamat wajib di isi',
            'jasa_pengiriman.required'=> 'Jasa pengiriman wajib di pilih',
            'jasa_pengiriman.in'=> 'Pilih Jasa pengiriman yang sudah ada',
            'qty.required'=> 'Quantity wajib di isi',
            'harga.required'=> 'Harga wajib di isi',
        ];
    }

    public function failedValidation(Validator $v) 
    {
        throw new HttpResponseException(response()->json([
            'status' => 'Error',
            'message' => 'Failed update order',
            'errors' => $v->errors()
        ], 400));
    }
}