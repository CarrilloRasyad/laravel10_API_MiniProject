<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMotorRequest;
use App\Http\Requests\UpdateMotorRequest;
use App\Http\Resources\MotorCollection;
use App\Http\Resources\MotorResource;
use App\Models\Motors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MotorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $motor = Motors::all();
            return response()->json([
                'status' => 'success',
                'message' => $motor->count() ? 'Data not found' : 'Data has found',
                'data' => new MotorCollection($motor)
            ], 200);
        } catch(\Exception $e) {
            Log::error('Error retrieving motors: ' . $e->getMessage());
            return $this->errorResponse('Failed load data', 500);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMotorRequest $request)
    {
        try{
            DB::beginTransaction();
            $motors = Motors::create($request->all());
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Motors have been added successfully',
                'data' => new MotorResource($motors)
            ], 201);
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Error creating motors' . $e->getMessage());
            return $this->errorResponse('Failed added motor', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $motors = Motors::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Motors has found!',
                'data' => new MotorResource($motors)
            ], 200);

        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Data Motors not found', 404);
        } catch (\Exception $e) {
            Log::error('Error retrieving data motors' .  $e->getMessage());
            return $this->errorResponse('Failed load data motors: ', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMotorRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $motor = Motors::findOrFail($id);
            $motor->update($request->all());
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Motors have been updated!',
                'data' => new MotorResource($motor)
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Motors not found', 404);
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating motors: ' . $e->getMessage());
            return $this->errorResponse('Failed load data motor',  500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();
            $motor = Motors::findOrFail($id);
            $motor->delete();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data Motors successfully deleted'
            ], 200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Data motor not found', 404);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            Log::error('Error deleting motors' . $e->getMessage());
            return $this->errorResponse('Failed load data motors',  500);
        }
    }

    public function errorResponse($message, $code) {
        return response()->json([
            'status' => 'error',
            'message'=> $message
        ], $code);
    }
}
