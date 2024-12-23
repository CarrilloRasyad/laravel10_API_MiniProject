<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Motor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'data' => $product
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = [
            'nama' => 'required',
            'merk' => 'required',
            'jasa_pengiriman' => 'required',
            'berat' => 'required',
            'alamat' => 'required',
            'qty' => 'required',
            'harga' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $validate );
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan data',
                'data' => $validator->fails()
            ], 400);
        }

        $product = new Product;
        $product->nama = $request->nama;
        $product->merk = $request->merk;
        $product->jasa_pengiriman = $request->jasa_pengiriman;
        $product->berat = $request->berat;
        $product->alamat = $request->alamat;
        $product->qty = $request->qty;
        $product->harga = $request->harga;

        $product->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Berhasil menambahkan data',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(empty($product)) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data tidak ditemukan',
                
            ], 404);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Data berhasil ditemukan',
            'data' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if(empty($product)) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data tidak ditemukan',
                'data' => $product
            ],404);
        }

        $rules = [
            'nama' => 'required|string',
            'merk' => 'required|string',
            'jasa_pengiriman' => 'required|string',
            'berat' => 'required|integer',
            'alamat' => 'required|string',
            'qty' => 'required|integer',
            'harga' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data product tidak dapat diubah',
                'data' => $validator->errors()
            ], 404);
        }

        // bukan update data tapi bikin data baru
        // $product = new Product();

        $product = Product::find($request->id);

        $product->nama = $request->nama;
        $product->merk = $request->merk;
        $product->jasa_pengiriman = $request->jasa_pengiriman;
        $product->berat  = $request->berat;
        $product->alamat = $request->alamat;
        $product->qty = $request->qty;
        $product->harga = $request->harga;

        $post = $product->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data berhasil diubah',
            'data' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(empty($product)) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data tidak ditemukan',
                'data' => $product
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Berhasil menghapus data'
        ], 200);
    }
}
