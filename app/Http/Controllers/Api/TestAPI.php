<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $makanan = Makanan::orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Makanan Ditemukan',
            'data' => $makanan
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = [
            'nama_makanan' => 'required|string',
            'jenis_makanan' => 'required|string',
            'harga' => 'required|integer',
            'asal_negara' => 'required|string',
            'rasa_makanan' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $validated);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan data makanan',
                'data' => $validator->errors()

            ], 400);
        }
        // membuat data baru
        $dataMakanan = new Makanan();
        $dataMakanan->nama_makanan = $request->nama_makanan;
        $dataMakanan->jenis_makanan = $request->jenis_makanan;
        $dataMakanan->harga = $request->harga;
        $dataMakanan->asal_negara = $request->asal_negara;
        $dataMakanan->rasa_makanan = $request->rasa_makanan;

        $dataMakanan->save();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Data Makanan Berhasil di Tambahkan',
            'data' => $dataMakanan
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $makanan = Makanan::find($id);
        if(empty($makanan)) {
            return response()->json([
                'status' => 'FAILED',
                'message' => 'Data Makanan dengan id tersebut tidak ditemukan'
            ], 404);
        }else {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Data dengan id tersebut berhasil ditemukan',
                'data' => $makanan
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $makanan = Makanan::find($id);
        if(empty($makanan)) {
            return response()->json([
                'status' => 'FAILED',
                'message' => 'Data tidak ditemukan',
                'data' => $makanan
            ], 404);
        }

        $peraturan = [
            'nama_makanan' => 'required|string',
            'jenis_makanan' => 'required|string',
            'harga' => 'required|integer',
            'asal_negara' => 'required|string',
            'rasa_makanan' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $peraturan);
        if($validator->fails()) {
            return response()->json([
                'status' =>'FAILED',
                'message' => 'Data makanan tidak dapat diupdate',
                'data' => $validator->errors()
            ], 404);
        }
        $makanan = Makanan::find($request->id);
        $makanan->nama_makanan = $request->nama_makanan;
        $makanan->jenis_makanan = $request->jenis_makanan;
        $makanan->harga = $request->harga;
        $makanan->asal_negara = $request->asal_negara;
        $makanan->rasa_makanan = $request->rasa_makanan;

        $post = $makanan->save();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Berhasil update data makanan',
            'data' => $makanan
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $makanan = Makanan::find($id);

        if(empty($makanan)) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data makanan tidak ditemukan'
            ], 404);
        }

        $hapusMakanan = $makanan->delete();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Data makanan berhasil di hapus'
        ], 200);
    }
}
