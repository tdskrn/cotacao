<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

/** Rotas para produto */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('getProducts', [ProductController::class, 'getProducts']);
    Route::get('searchProducts', [ProductController::class, 'searchProducts']);
    Route::post('storeProduct', [ProductController::class, 'storeProduct']);
    Route::post('updateProduct/{id}', [ProductController::class, 'updateProduct']);
    Route::post('deleteProduct/{id}', [ProductController::class, 'deleteProduct']);
});


/** Rotas autenticacao */
Route::middleware(['cors'])->post('login', [AuthController::class, 'login']);
Route::middleware(['cors'])->post('register', [AuthController::class, 'register']);
Route::middleware(['auth:sanctum'])->post('logout', [AuthController::class, 'logout']);
