<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::all();
        return response()->json([
            'status' => 'success',
            'message'=> 'Data ditemukan',
            'data' => $order
        ], 200);
        if(empty($order)) {
            return response()->json([
                'status'=> 'error',
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = [
            'name' => 'required',
            'alamat' => 'required',
            'jasa_pengiriman' => 'required',
            'qty' => 'required|integer',
            'harga' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $validasi);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message'=> 'Data gagal di tambahkan',
                'data'=> $validator->errors()
            ], 400);
        }

        $order = new Order();
        $order->name = $request->name;
        $order->alamat = $request->alamat;
        $order->jasa_pengiriman = $request->jasa_pengiriman;
        $order->qty = $request->qty;
        $order->harga = $request->harga;

        $order->save();

        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil di tambahkan',
            'data'=> $order
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        if(empty($order)) {
            return response()->json([
                'status' => false,
                'message'=> 'Data order dengan id tersebut tidak ditemukan',
                'data'=> null
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message'=> 'Data ditemukan',
            'data'=> $order
        ], 200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);
        if(empty($order)) {
            return response()->json([
                'status' => 'error',
                'message'=> 'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'name' => 'required',
            'alamat'=> 'required',
           'jasa_pengiriman'=> 'required',
            'qty'=> 'required',
            'harga'=> 'required',
        ];

        // data bisa duplicate, dapat manipulasi objek/isi objek
        $order = Order::find($request->id);
        $order->name = $request->name;
        $order->alamat = $request->alamat;
        $order->jasa_pengiriman = $request->jasa_pengiriman;
        $order->qty = $request->qty;
        $order->harga = $request->harga;

        $order->save();

        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil diubah',
            'data'=> $order
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if(empty($order)) {
            return response()->json([
                'status' => 'error',
                'message'=> 'Gagal menghapus data dengan id tersebut'
            ], 400);
        }
        $order->delete();

        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil dihapus'
        ], 202);
    }
}
