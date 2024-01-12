<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }


    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'unity' => ['required'],
        ]);

        Product::create([
            'name' => $request->name,
            'unity' => $request->unity,
            'isQuoted' => $request->isQuoted,
        ]);

        return response()->json('Success');
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'unity' => ['required'],
        ]);

        Product::where('id', $id)->update([
            'name' => $request->name,
            'unity' => $request->unity,
            'isQuoted' => $request->isQuoted,
        ]);
        return response()->json('Success');
    }

    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        return response()->json('Success');
    }
}
