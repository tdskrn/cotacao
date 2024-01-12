<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendedorController extends Controller


{
    public function __construct()
    {
        $this->middleware('auth:vendedor');
    }



    public function create()
    {
        return view("vendedores.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendedores',
            'telephone' => 'required|string|min:11',
            'password' => 'required|string|min:6|confirmed',

        ]);

        Vendedor::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }
}
