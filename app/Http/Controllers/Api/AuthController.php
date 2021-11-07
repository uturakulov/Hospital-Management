<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        validator($request->all(), [
            'email' => ['required', 'email'],
            'password' => 'required'
        ])->validate();

        $user = Admin::where('email', $request->email)->first();

        if (Hash::check($request->password, $user->getAuthPassword())) {
            return [
                'token' => $user->createToken(time())->plainTextToken
            ];
        }
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
    }
}
