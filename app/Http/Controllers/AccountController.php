<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\UserModel;

class AccountController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $data = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);
        return $this->tryCatch(function () use ($data) {
            UserModel::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
            return $this->response([
                'message' => 'Account created successfully.',
            ], 200);
        });
    }
}