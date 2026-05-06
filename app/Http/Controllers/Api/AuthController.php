<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login gagal'
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'data' => $user
        ]);
    }
    public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Logout berhasil'
    ]);
}
}