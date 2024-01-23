<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Quote;
use App\Models\QuotedProduct;
use Exception;
use Illuminate\Http\Request;

class QuotedProductController extends Controller
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

    public function saveQuotePrice(Request $request)

    {
        try {
            $quoted = Quote::where('status', 'Aberta')->first();
            $quotedProduct = QuotedProduct::updateOrCreate(
                [
                    'quote_id' => $quoted->id,
                    'vendor_id' => $request->vendor_id,
                    'product_id' => $request->product_id,
                ],
                ['price' => $request->price]
            );

            return response()->json(['message' => 'Preço cotado com sucesso', 'data' => $quotedProduct]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getVendorPrices(Request $request)
    {

        $quoted = Quote::where('status', 'Aberta')->first();
        $vendorId = auth()->user()->id;


        $prices = QuotedProduct::where('quote_id', $quoted->id)
            ->where('vendor_id', $vendorId)
            ->pluck('price', 'product_id');

        return response()->json($prices);
    }
}
