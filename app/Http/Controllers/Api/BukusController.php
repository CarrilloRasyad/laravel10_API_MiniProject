<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Http\Resources\BukuCollection;
use App\Http\Resources\BukuResource;
use App\Models\Buku;
use App\Models\Bukus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BukusController extends Controller
{
    public function index() 
    {
        $bukus = Bukus::all();
        return response()->json([
            'status' => 'Success',
            'message' => $bukus->count() ? 'Data found!' : 'Data not found',
            'data' => new BukuCollection($bukus)
        ], 200);
    }
    
    public function show(string $id) 
    {
        try {
            $bukus = Bukus::findOrFail($id);
            return response()->json([
                'status' => 'Success',
                'message' => 'Data has found!',
                'data' => new BukuResource($bukus)
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Data Buku Not Found', 404);
        } catch (\Exception $e) {
            Log::error('Error retrieving Data:'. $e->getMessage());
            return $this->errorResponse('Failed to load data', 500);
        }
    }

    public function store(StoreBukuRequest $request)
    {
        try {
            DB::beginTransaction();
            // $bukus = collect($request->validated())->map(function($data){
            //     return Bukus::created($data);
            // });

            $buku = Bukus::create($request->all());

            DB::commit();
            return response()->json([
                'status' => 'Success',
                'message' => 'Data Buku have been created',
                'data' => new BukuResource($buku)
            ], 201);

        } 
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error Retrieving Data: ' . $e->getMessage());
            return $this->errorResponse('Failed added buku', 500);
        }
    }

    public function update(UpdateBukuRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $buku = Bukus::findOrFail($id);
            $buku->update($request->all());

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Buku not found', 404);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error retrieving data buku: '. $e->getMessage());
            return $this->errorResponse('Failed to update data buku:', 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $buku = Bukus::findOrFail($id);
            $buku->delete();
            DB::commit();

            return response()->json([
                'status' => 'Success',
                'message' => 'Data has been deleted'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting buku: ' . $e->getMessage());
            return $this->errorResponse('Failed load data buku: ', 500);
        }

    }

    public function errorResponse($message, $code) {
        return response()->json([
            'status' => 'failed',
            'message' => $message
        ], $code);
    }
}
