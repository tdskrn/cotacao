<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class QuoteProductController extends Controller
{
    public function getQuotedProducts()
    {
        try {
            $products = Product::where('isQuoted', 1)->get();

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
