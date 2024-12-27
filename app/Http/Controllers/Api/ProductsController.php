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

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // $products = Products::paginate(10);
            $products = Products::all();
            return response()->json([
                'status' => 'success',
                'message' => $products->count() ? 'Data has found' : 'Data not found',
                'data'=> new ProductsCollection($products),
                // 'meta' => [
                //     'total'=> $products->total(),
                //     'page'=> $products->currentPage(),
                //     'last_page' => $products->lastPage()
                // ]
            ], 200);
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
            // $cek = $request->all();
            // Log::info('Cek data : '. json_encode($cek));
            DB::beginTransaction();
            $products = Products::create($request->all());
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message'=> 'Product have been added successfully',
                'data' => new ProductsResource($products)
            ], 201);

        } catch(\Exception $e) {
            // $cek = $request->all();
            // Log::info('Cek data : '. json_encode($cek));
            DB::rollBack();
            Log::error('Error creating products: ' . $e->getMessage());
            return $this->errorResponse('Failed added products', 500);
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
                'status' => 'success',
                'message' => 'Products has found!',
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
            $products->update($request->all());

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data products successfully updated',
                'data' => new ProductsResource($products)
            ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Products not found', 404);
        }
          catch(\Exception $e) {
            DB::rollBack();
            Log::error('Error updating products: '. $e->getMessage());
            return $this->errorResponse('Failed load data', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $product = Products::findOrFail($id);
            $product->delete();

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
            return $this->errorResponse('Failed delete product', 500);
        }
    }

    public function errorResponse($message, $code) {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}
