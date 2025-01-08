<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMobilsRequest;
use App\Http\Requests\UpdateMobilsRequest;
use App\Http\Resources\MobilsCollection;
use App\Http\Resources\MobilsResource;
use App\Models\Mobils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MobilsController extends Controller
{
    public function index() 
    {
        $mobils = Mobils::all();
        return response()->json([
            'status' => 'success',
            'message' => $mobils->count() ? 'Data not found' : 'Data has found',
            'data' => new MobilsCollection($mobils)
        ], 200);
    }

    public function show(string $id) 
    {
        try {
            $mobils = Mobils::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Data mobils has found',
                'data' => new MobilsResource($mobils)
            ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Data mobils not found', 404);
        } catch(\Exception $e){
            Log::error('Error retrieving data mobil: ' . $e->getMessage());
            return $this->errorResponse('Failed load data mobils', 500);
        }
    }

    public function store(StoreMobilsRequest $request)
    {
        try {
            DB::beginTransaction();
            $mobils = Mobils::create($request->all());
            DB::commit();

            return response()->json([
                'status' => 'succes',
                'message' => 'Mobils have been added successfully',
                'data' => new MobilsResource($mobils)
            ], 201);
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Error added data mobils' . $e->getMessage());
            return $this->errorResponse('Failed added mobils', 500);    
        }
    }

    public function update(UpdateMobilsRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $mobils = Mobils::findOrFail($id);
            $mobils->update($request->all());
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data have been updated!',
                'data' => new MobilsResource($mobils)
            ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Mobils not found', 404);
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Error updating mobils: ' . $e->getMessage());
            return $this->errorResponse('Failed load data mobils', 500);
        }
    }

    public function destroy(string $id) 
    {
        try{
            DB::beginTransaction();
            $mobils = Mobils::findOrFail($id);
            $mobils->delete();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Mobils have been deleted'
            ],200);

        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Data mobils not found', 404);
        }catch(\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting mobils' . $e->getMessage());
            return $this->errorResponse('Failed load data mobils', 500);
        }
    }

    public function errorResponse($code, $message) {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $code);
    }
}
