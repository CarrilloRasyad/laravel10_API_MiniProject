<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Olahraga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OlahragaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $olahraga = Olahraga::all();
        return response()->json([
            'status' => 'Success',
            'message' => 'Data berhasil ditemukan',
            'data' => $olahraga
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = [
            'cabor' => 'required|string',
            'jenis_olahraga' => 'required|string',
            'jumlah_pemain' => 'required|integer',
            'lokasi_bermain' => 'required|string',
            'deskripsi' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $validated);
        if($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data tidak ditemukan',
                'data' => $validator->errors()
            ], 404);
        }

        $olahraga = new Olahraga();
        $olahraga->cabor = $request->cabor;
        $olahraga->jenis_olahraga = $request->jenis_olahraga;
        $olahraga->jumlah_pemain = $request->jumlah_pemain;
        $olahraga->lokasi_bermain = $request->lokasi_bermain;
        $olahraga->deskripsi = $request->deskripsi;

        $olahraga->save();
        
        return response()->json([
            'status' => 'Success',
            'message' => 'Data Berhasil di Tambahkan',
            'data' => $olahraga
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $olahraga = Olahraga::find($id);

        if(empty($olahraga)) {
            return response()->json([
                'status' => false,
                'message' => 'Data dengan Id tersebut tidak ditemukan',
                
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data dengan Id tersebut ditemukan',
                'data' => $olahraga
            ], status: 200);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $olahraga = Olahraga::find($id);
        if(empty($olahraga)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'cabor' => 'required|string',
            'jenis_olahraga' => 'required|string',
            'jumlah_pemain' => 'required|integer',
            'lokasi_bermain' => 'required|string',
            'deskripsi' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $olahraga = Olahraga::find($request->id);
        $olahraga->cabor = $request->cabor;
        $olahraga->jenis_olahraga = $request->jenis_olahraga;
        $olahraga->jumlah_pemain = $request->jumlah_pemain;
        $olahraga->lokasi_bermain = $request->lokasi_bermain;
        $olahraga->deskripsi = $request->deskripsi;

        $olahraga->save();

        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil di Update',
            'data' => $olahraga
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $olahraga = Olahraga::find($id);
        if(empty($olahraga)) {
            return response()->json([
                'status' => 'Failed',
                'messsage' => 'Data tidak ditemukan',
            ], 404);
        }

        $olahraga->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data berhasil di hapus',
            'data' => $olahraga
        ], 410);
    }
}
