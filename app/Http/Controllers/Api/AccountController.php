<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;

class AccountController extends Controller
{
    // ================= REGISTER =================
    public function register(Request $request)
    {
        try {

            $validated = $request->validate([

                'name' => 'required|string|max:255',

                'nik' => 'required|digits:16|unique:users,nik',

                'email' => 'required|email|unique:users,email',

                'no_hp' => 'required|min:10|max:15',

                'alamat' => 'required',

                'tempat_lahir' => 'required',

                'tgl_lahir' => 'required|date',

                'jenis_kelamin' => 'required|in:L,P',

                'agama' => 'required',

                'pekerjaan' => 'required',

                'password' => 'required|min:6',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'nik' => $validated['nik'],
                'email' => $validated['email'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tgl_lahir' => $validated['tgl_lahir'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'agama' => $validated['agama'],
                'pekerjaan' => $validated['pekerjaan'],
                'password' => Hash::make($validated['password']),
                'role' => 'warga',
            ]);

            event(new Registered($user));

            return response()->json([
                'status' => 'success',
                'message' => 'Register berhasil',
                'data' => $user
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Throwable $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // ================= VERIFY EMAIL =================
    public function verifyEmail(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Email sudah diverifikasi'
            ]);
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return response()->json([
            'status' => 'success',
            'message' => 'Email berhasil diverifikasi'
        ]);
    }

    // ================= CHANGE PASSWORD =================
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6'
        ]);

        $user = $request->user();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah'
        ]);
    }

    // ================= FORGOT PASSWORD =================
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'status' => $status === Password::RESET_LINK_SENT
                ? 'success'
                : 'error',
            'message' => __($status)
        ]);
    }

    // ================= RESET PASSWORD =================
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->update([
                    'password' => Hash::make($password)
                ]);
            }
        );

        return response()->json([
            'status' => $status === Password::PASSWORD_RESET
                ? 'success'
                : 'error',
            'message' => __($status)
        ]);
    }

    // ================= CHECK EMAIL =================
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Email ditemukan'
        ]);
    }

    // ================= DIRECT RESET PASSWORD =================
    public function directResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak ditemukan'
            ], 404);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah'
        ]);
    }
}