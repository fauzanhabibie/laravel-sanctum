<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;


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

Route::get('/', function(){
    return response()->json([
        'status' => false, 
        'message' => 'akses tidak di perbolehkan ',
    ],401);
})->name('login'); 


Route::get('/produks', [ProdukController::class, 'index'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']); 
Route::post('/login', [AuthController::class, 'login']); 

// Route::post('/produks', [App\Http\Controllers\ProdukController::class, 'store']);
// Route::get('/produks/{produk}', [App\Http\Controllers\ProdukController::class, 'show']);
// Route::put('/produks/{produk}', [App\Http\Controllers\ProdukController::class, 'update']);
// Route::delete('/produks/{produk}', [App\Http\Controllers\ProdukController::class, 'destroy']);




