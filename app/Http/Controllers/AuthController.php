<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {


        $user = Vendor::where('email', $request->email)->first();

        $password = Hash::check($request->password, $user->password);
        $password = $request->password;
        if (!$user || !$password) {
            throw ValidationException::withMessages(['email' => 'As credenciais estão incorretas']);
        }

        // Logout others devices
        // if($request->has('logout_others_devices'))
        $user->tokens()->delete();

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token' => $token,

        ]);
    }

    public function register(Request $request)
    {
        // protected $fillable = ['name', 'email', 'telephone', 'password'];
        try {
            $user = Vendor::create([
                'name' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'password' => Hash::make($request->password),
            ]);
            $user->tokens()->delete();
            $token = $user->createToken($request->device_name)->plainTextToken;
            return response()->json(['message' => 'usuario registrado com sucesso', 'token' => $token, 'user' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao registrar usuário'], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
