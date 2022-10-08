<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'status' => true,
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'message' => "Logged in successfully !"
        ]);
    }

    public function logout(Request $request)
    {
        if (! optional(optional($request->user())->currentAccessToken())->delete()) {
            return response()->json([
                'status' => false,
                'message' => "Failed to Log out !"
            ]);   
        }
        
        return response()->json([
            'status' => true,
            'token' => null,
            'message' => "Logged out successfully !"
        ]);
    }

    public function me(Request $request) {
        return $request->user();
    }

}
