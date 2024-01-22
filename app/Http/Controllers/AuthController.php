<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 0;
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
            'user' => $user,
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

    public function isAdmin(Request $request)
    {
        $isAdmin = $request->isAdmin == self::ROLE_ADMIN;
        return response()->json(['isAdmin' => $isAdmin]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
