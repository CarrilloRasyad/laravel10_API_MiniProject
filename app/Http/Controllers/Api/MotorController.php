<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Makanan;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motor = Motor::all();
        return response()->json([
            'status' => 'Success',
            'message' => 'Data berhasil ditemukan',
            'data' => $motor
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = [
            'nama' => 'required|string',
            'merk' => 'required|string',
            'harga' => 'required|integer',
            'jenis' => 'required|string',
            'kecepatan' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $validated);
        if($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data gagal di tambahkan',
                'data' => $validator->errors()
            ], 400);
        }

        $motor = new Motor();
        $motor->nama = $request->nama;
        $motor->merk = $request->merk;
        $motor->harga = $request->harga;
        $motor->jenis = $request->jenis;
        $motor->Kecepatan = $request->Kecepatan;

        $motor->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data motor berhasil di tambahkan',
            'data' => $motor
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $motor = Motor::find($id);

        if(empty($motor)) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data motor dengan id tersebut tidak ditemukan'
            ], 404);
        }else {
            return response()->json([
                'status' => 'Success',
                'message' => 'Data motor ditemukan',
                'data' => $motor
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $motor = Motor::find($id);
        if(empty($motor)) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data motor tidak ditemukan',
                'data' => $motor
            ], 404);
        }

        $rules = [
            'nama' => 'required|string',
            'merk' => 'required|string',
            'harga' => 'required|integer',
            'jenis' => 'required|string',
            'Kecepatan' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data motor tidak dapat diubah',
                'data' => $validator->errors()
            ], 404);
        }

        $motor = Motor::find($request->id);
        $motor->nama = $request->nama;
        $motor->merk = $request->merk;
        $motor->harga = $request->harga;
        $motor->jenis = $request->jenis;
        $motor->Kecepatan = $request->Kecepatan;

        $post = $motor->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data berhasil diubah',
            'data' => $motor
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $motor = Motor::find($id);
        if(empty($motor)) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data motor tidak ditemukan'
            ], 404);
        }

        $motor->delete();
        
        return response()->json([
            'status' => 'Succes',
            'message' => 'Data berhasil di hapus'
        ], 200);
    }
}
