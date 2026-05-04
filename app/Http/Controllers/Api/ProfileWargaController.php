<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileWargaController extends Controller
{
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'data' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
}