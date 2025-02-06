<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductsCollection;
use App\Http\Resources\ProductsResource;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Products::all();
            return response()->json([
                'status' => $products->count() ? 'Success' : 'Error',
                'message' => $products->count() ? 'Data has found' : 'Data not found',
                'data'=> new ProductsCollection($products),
            ], $products->count() ? 200 : 404);
        } catch(\Exception $e) {
            Log::error('Error retrieving product: '. $e->getMessage());
            return $this->errorResponse('Failed load data', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();
            // $products = Products::create($request->all());

            $validatedData = $request->validated();
            $products = Products::create($validatedData);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message'=> 'Product have been added successfully',
                'data' => new ProductsResource($products)
            ], 201);

        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Error creating products: ' . $e->getMessage());
            return $this->errorResponse('Failed added products', 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $products = Products::findOrFail($id);

            return response()->json([
                'status' => 'Success',
                'message' => 'Data found',
                'data' => new ProductsResource($products)
            ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Data products not found', 404);
        } catch(\Exception $e) {
            Log::error('Error retrieving products: ' . $e->getMessage());
            return $this->errorResponse('Failed load data', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $products = Products::findOrFail($id);
            
            $validatedData = $request->validated();
            $products->update($validatedData);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data products successfully updated',
                'data' => new ProductsResource($products)
            ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Products not found', 404);
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Error updating products: '. $e->getMessage());
            return $this->errorResponse('Failed Update Data', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $products = Products::findOrFail($id);
            $products->delete();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Product has been successfully deleted'
            ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Data product not found', 404);
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting product: ' . $e->getMessage());
            return $this->errorResponse('Failed delete product', 400);
        }
    }

    public function destroyAll()
    {
        try {
            DB::beginTransaction();
            Products::truncate();

            DB::commit();
            return response()->json([
                'status' => 'Success',
                'message' => 'All Products Successfully Deleted'
            ], 200);

        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting all products: ' . $e->getMessage());
            return $this->errorResponse('Failed to delete all products', 400);
        }
    }
    public function errorResponse($message, $code) {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}
