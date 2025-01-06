<?php

use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\MobilController;
use App\Http\Controllers\Api\MotorController;
use App\Http\Controllers\Api\MotorsController;
use App\Http\Controllers\Api\OlahragaController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\SekolahController;
use App\Http\Controllers\Api\TestAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// api buku
Route::get('buku', [BukuController::class, 'index']);
Route::get('buku/{id}', [BukuController::class, 'show']);
Route::post('buku', [BukuController::class, 'store']);
Route::put('buku/{id}', [BukuController::class, 'update']);
Route::delete('buku/{id}', [BukuController::class, 'destroy']);


// api mobil
Route::get('mobil', [MobilController::class, 'index']);
Route::get('mobil/{id}', [MobilController::class, 'show']);
Route::post('mobil', [MobilController::class, 'store']);
Route::put('mobil/{id}', [MobilController::class, 'update']);
Route::delete('mobil/{id}', [MobilController::class, 'destroy']);


// api makanan
Route::get('makanan', [TestAPI::class, 'index']);
Route::get('makanan/{id}', [TestAPI::class, 'show']);
Route::post('makanan', [TestAPI::class, 'store']);
Route::put('makanan/{id}', [TestAPI::class, 'update']);
Route::delete('makanan/{id}', [TestAPI::class, 'destroy']);


// api motor
Route::get('motor', [MotorController::class, 'index']);
Route::get('motor/{id}', [MotorController::class, 'show']);
Route::post('motor', [MotorController::class, 'store']);
Route::put('motor/{id}', [MotorController::class, 'update']);
Route::delete('motor/{id}', [MotorController::class, 'destroy']);

// api product
Route::get('product', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'store']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);

// api olahraga
Route::get('olahraga', [OlahragaController::class, 'index']);
Route::post('olahraga', [OlahragaController::class, 'store']);
Route::get('olahraga/{id}', [OlahragaController::class, 'show']);
Route::put('olahraga/{id}', [OlahragaController::class, 'update']);
Route::delete('olahraga/{id}', [OlahragaController::class, 'destroy']);


// api sekolah
Route::get('sekolah', [SekolahController::class, 'index']);
Route::post('sekolah', [SekolahController::class, 'store']);
Route::get('sekolah/{id}', [SekolahController::class, 'show']);
Route::put('sekolah/{id}', [SekolahController::class, 'update']);
Route::delete('sekolah/{id}', [SekolahController::class, 'destroy']);

//api order
Route::get('order', [OrderController::class,'index']);
Route::post('order', [OrderController::class,'store']);
Route::get('order/{id}', [OrderController::class,'show']);
Route::put('order/{id}', [OrderController::class,'update']);
Route::delete('order/{id}', [OrderController::class,'destroy']);

// api orders best practice
Route::get('orders', [OrdersController::class,'index']);
Route::post('orders', [OrdersController::class,'store']);
Route::get('orders/{id}', [OrdersController::class,'show']);
Route::put('orders/{id}', [OrdersController::class,'update']);
Route::delete('orders/{id}', [OrdersController::class,'destroy']);


// api products best practice
Route::get('products', [ProductsController::class,'index']);
Route::post('products', [ProductsController::class,'store']);
Route::get('products/{id}', [ProductsController::class,'show']);
Route::put('products/{id}', [ProductsController::class,'update']);
Route::delete('products/{id}', [ProductsController::class,'destroy']);

// api motors best practice
Route::get('motors', [MotorsController::class, 'index']);
Route::post('motors', [MotorsController::class, 'store']);
Route::get('motors/{id}', [MotorsController::class, 'show']);
Route::put('motors/{id}', [MotorsController::class, 'update']);
Route::delete('motors/{id}', [MotorsController::class, 'destroy']);
