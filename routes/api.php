<?php

use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\MobilController;
use App\Http\Controllers\Api\MotorController;
use App\Http\Controllers\Api\ProductController;
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

// product
Route::get('product', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'store']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);