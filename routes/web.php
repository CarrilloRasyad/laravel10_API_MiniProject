<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/product', function () {
    return view('products.index');
});

Route::get('/makanan', function() {
    return view('makanan.index');
});


Route::get('/buku', function () {
    return view('buku.index');
});

Route::get('/dbmobil', function() {
    return view('mobil.index');
});


Route::get('/dbmotor', function() {
    return view('motor.index');
});

Route::get('/olahraga', function() {
    return view('olahraga.index');
});

Route::get('/sekolah', function () {
    return view('sekolah.index');
});