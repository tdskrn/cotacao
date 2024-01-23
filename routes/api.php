<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuotedProductController;
use App\Http\Controllers\QuoteProductController;
use App\Http\Controllers\VendorController;
use App\Models\Quote;
use App\Models\QuoteProduct;
use App\Models\Vendor;
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

/** Rotas para Produto Admin */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('getProducts', [ProductController::class, 'getProducts']);
    Route::get('searchProducts', [ProductController::class, 'searchProducts']);
    Route::post('storeProduct', [ProductController::class, 'storeProduct']);
    Route::post('updateProduct/{id}', [ProductController::class, 'updateProduct']);
    Route::post('deleteProduct/{id}', [ProductController::class, 'deleteProduct']);
});

/** Rotas Vendedores Admin */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('getVendors', [VendorController::class, 'getVendors']);
    Route::post('updateVendor/{id}', [VendorController::class, 'updateVendor']);
    Route::post('deleteVendor/{id}', [VendorController::class, 'deleteVendor']);
});

/** Rotas Cotações Admin */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('getQuotes', [QuoteController::class, 'getQuotes']);
    Route::get('getQuotedProducts', [QuotedProductController::class, 'getQuotedProducts']);
    Route::get('/getProductPrices/{productId}', [QuotedProductController::class, 'getProductPrices']);
    Route::get('getLowestPrices', [QuotedProductController::class, 'getLowestPrices']);
    // Route::post('updateVendor/{id}', [VendorController::class, 'updateVendor']);
    // Route::post('deleteVendor/{id}', [VendorController::class, 'deleteVendor']);
    Route::post('storeQuote', [QuoteController::class, 'storeQuote']);
});

/** Rotas Cotações User */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user/getQuotedProducts', [QuotedProductController::class, 'getQuotedProducts']);
    Route::get('user/getVendorPrices/', [QuotedProductController::class, 'getVendorPrices']);
    Route::post('user/saveQuotePrice', [QuotedProductController::class, 'saveQuotePrice']);
});

/** Rotas autenticacao */
Route::middleware(['cors'])->post('login', [AuthController::class, 'login']);
Route::middleware(['cors'])->post('register', [AuthController::class, 'register']);
Route::middleware(['cors'])->post('register/admin', [AuthController::class, 'registerAdmin']);
Route::middleware(['auth:sanctum'])->post('logout', [AuthController::class, 'logout']);
