<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getProducts()
    {
        $products = Product::paginate(10);

        return response()->json($products);
    }

    public function searchProducts(Request $request)
    {
        $term = $request->input("term");
        $results = Product::where('description', 'like', '%' . $term . '%')->paginate(10);
        return response()->json($results);
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
            'description' => ['required'],
            'unity' => ['required'],
        ]);

        Product::where('id', $id)->update([
            'description' => $request->description,
            'unity' => $request->unity,
            'isQuoted' => $request->isQuoted,
        ]);
        return response()->json('Success');
    }

    public function deleteProduct($id)
    {
        try {
            Product::where('id', $id)->delete();
            return response()->json('Success');
        } catch (\Exception $e) {
            return response()->json('' . $e->getMessage());
        }
    }
}
