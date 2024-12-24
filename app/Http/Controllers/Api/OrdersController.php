<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        $orders = Orders::paginate(10);

        return response()->json([
            'status' => 'success',
            'message'=> $orders->count() ? 'Data found' : 'Data not found',
            'data'=> new OrderCollection($orders),
            'meta' => [
                'total' => $orders->total(),
                'page' => $orders->currentPage(),
                'last_page' => $orders->lastPage()
            ]

        ], 200);

        } catch(\Exception $e) {
            Log::error('Error retrieving orders: ' . $e->getMessage());
            return $this->errorResponse('Failed load data', 500);
        }
    }

    public function store(StoreOrderRequest $request)
    {
        try {
            DB::beginTransaction();

            $orders = collect($request->validated())->map(function ($data) {
                return Orders::create($data);
            });

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Orders have been added successfully',
                'data' => OrderResource::collection($orders),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating orders: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add orders',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreOrderRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $order = Orders::create($request->validated());

    //         DB::commit();

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Order has added successfully',
    //             'data'=> new OrderResource($order),
    //         ], 201);

    //     } catch(\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Error creating order: ' . $e->getMessage());
    //         return $this->errorResponse('Failed added order', 500);
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $order = Orders::findOrFail($id);
            return response()->json([
                'status' => 'success', 
                'message' => 'Order has found!',
                'data' => new OrderResource( $order ),
            ], 200);


        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Data Order not found', 404);
        } catch (\Exception $e) {
            Log::error('Error retrieving order: ' . $e->getMessage());
            return $this->errorResponse('Failed to load data', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $order = Orders::findOrFail($id);
            $order->update($request->all());

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message'=> 'Data order successfully updated',
                'data'=> new OrderResource($order),
            ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Order not found', 404);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating order: ' . $e->getMessage());
            return $this->errorResponse('Failed update order', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $order = Orders::findOrFail($id);
            $order->delete();

            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Order has been successfully deleted'
            ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Data Order not found' ,404);
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting order: ' . $e->getMessage());
            return $this->errorResponse('Deleted order has been Failed', 500);
        }
    }

    public function errorResponse($message, $code) {
        return response()->json([
            'status' => 'error',
            'message'=> $message
        ], $code);
    }
}