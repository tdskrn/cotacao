<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function getVendors()
    {
        $vendors = Vendor::paginate(10);

        return response()->json($vendors);
    }

    public function updateVendor(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'telephone' => ['required'],
        ]);

        Vendor::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'isAdmin' => $request->isAdmin,
        ]);
        return response()->json('Success');
    }

    public function deleteVendor($id)
    {
        try {
            Vendor::where('id', $id)->delete();
            return response()->json('Success');
        } catch (\Exception $e) {
            return response()->json('' . $e->getMessage());
        }
    }
}


// protected $fillable = ['name', 'email', 'telephone', 'password'];