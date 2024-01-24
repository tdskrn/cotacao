<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller

{

    public function getQuotes()
    {
        $quotes = Quote::paginate(10);

        return response()->json($quotes);
    }
    public function storeQuote(Request $request)
    {

        try {
            Quote::create([
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
            return response()->json('Success');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function closeQuotes(Request $request)
    {

        try {
            Quote::where('id', $request->quote_id)->update(['status' => $request->status]);
            Product::where('isQuoted', 1)->update(['isQuoted' => 0]);
            return response()->json('Cotacao e produtos atualizados com sucesso');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
