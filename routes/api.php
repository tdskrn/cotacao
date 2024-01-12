<?php

use App\Http\Controllers\ProductController;
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

/** Rotas para produto */
Route::get('getProducts', [ProductController::class, 'getProducts']);
Route::post('storeProduct', [ProductController::class, 'storeProduct']);
Route::post('updateProduct/{id}', [ProductController::class, 'updateProduct']);
Route::post('deleteProduct/{id}', [ProductController::class, 'deleteProduct']);
