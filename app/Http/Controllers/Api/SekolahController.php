<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sekolah = Sekolah::all();
        return response()->json([
            'status' => true,
            'message' => 'Semua Data Sekolah Ditemukan',
            'data' => $sekolah
        ], 200);
        if(empty($sekolah)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Tersedia'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_guru' => 'required|string',
            'email' => 'required|string',
            'NUPTK' => 'required|integer',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'wali_kelas' => 'required|string',
            'matpel' => 'required|string',
            'gaji' => 'required|integer',
            'alamat' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data tidak dapat ditambahkan',
                'data' => $validator->errors()
            ], 400);
        }

        $sekolah = new Sekolah();
        $sekolah->nama_guru = $request->nama_guru;
        $sekolah->email = $request->email;
        $sekolah->NUPTK = $request->NUPTK;
        $sekolah->umur = $request->umur;
        $sekolah->jenis_kelamin = $request->jenis_kelamin;
        $sekolah->wali_kelas = $request->wali_kelas;
        $sekolah->matpel = $request->matpel;
        $sekolah->gaji = $request->gaji;
        $sekolah->alamat = $request->alamat;

        $sekolah->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data Berhasil di Tambahkan',
            'data' => $sekolah
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sekolah = Sekolah::find($id);
        if(empty($sekolah)) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data dengan id tersebut tidak ditemukan'
            ], 404);
        } else {
            return response()->json([
                'status' => 'Success',
                'message' => 'Data dengan id tersebut ditemukan',
                'data' => $sekolah
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sekolah = Sekolah::find($id);
        if(empty($sekolah)) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'nama_guru' => 'required|string',
            'email' => 'required|string',
            'NUPTK' => 'required|integer',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'wali_kelas' => 'required|string',
            'matpel' => 'required|string',
            'gaji' => 'required|integer',
            'alamat' => 'required|string' 
        ];

        $validator = Validator::make($request->all, $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak dapat di update'
            ], 404);
        }

        $sekolah = Sekolah::find($request->id);
        $sekolah->nama_guru = $request->nama_guru;
        $sekolah->email = $request->email;
        $sekolah->NUPTK = $request->NUPTK;
        $sekolah->umur = $request->umur;
        $sekolah->jenis_kelamin = $request->jenis_kelamin;
        $sekolah->wali_kelas = $request->wali_kelas;
        $sekolah->matpel = $request->matpel;
        $sekolah->gaji = $request->gaji;
        $sekolah->alamat = $request->alamat;

        $sekolah->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data Berhasil Di ubah'
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sekolah = Sekolah::find($id);
        if(empty($sekolah)) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $sekolah->delete();

        return response()->json([
            'status' => 'Success', 
            'message' => 'Data berhasil di hapus'
        ], 410);
    }
}
