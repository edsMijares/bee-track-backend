<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'nullable|string|email',
            'username' => 'nullable|string',
            'password' => 'required|string',
        ]);
        return $this->tryCatch(function () use ($data, $request) {
            $user = UserModel::where('email', $data['email'] ?? null)
                ->orWhere('username', $data['username'] ?? null)
                ->first();

            if (!$user || !password_verify($data['password'], $user->password)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            Auth::login($user);
            $request->session()->regenerate();

            return $this->response([
                'message' => 'Login successful.',
            ], 200);
        });
    }
    public function logout(Request $request)
    {
        return $this->tryCatch(function () use ($request) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return $this->response([
                'message' => 'Logout successful.',
            ], 200);
        });
    }
}
