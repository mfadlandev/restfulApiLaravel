<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'outlet_id' => 'nullable|exists:outlets,id',
        ]);

        // Register publik sebaiknya tidak digunakan untuk menentukan role.
        // Pembuatan akun admin/karyawan dilakukan oleh admin yang berwenang.

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'outlet_id' => $validated['outlet_id'] ?? null,
        ]);

        return response()->json([
            'message' => 'Register success',
            'user' => $user->load(['role', 'outlet']),
        ], 201);
    }

    // LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::with(['role', 'outlet'])
            ->where('email', $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role->name,
                'outlet' => $user->outlet ? [
                    'id' => $user->outlet->id,
                    'name' => $user->outlet->name,
                ] : null,
            ],
        ]);
    }

    // PROFILE
    public function profile(Request $request)
    {
        $user = $request->user()->load(['role', 'outlet']);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role->name,
            'outlet' => $user->outlet ? [
                'id' => $user->outlet->id,
                'name' => $user->outlet->name,
            ] : null,
        ]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout success',
        ]);
    }
}
