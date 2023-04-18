<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAPIRequest;
use App\Http\Requests\RegisterAPIRequest;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(RegisterAPIRequest $request): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        $fields = $request->validated();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(LoginAPIRequest $request): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        $fields = $request->validated();

        // check email
        $user = User::where('email', $fields['email'])->first();

        // Check pw
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }


}
