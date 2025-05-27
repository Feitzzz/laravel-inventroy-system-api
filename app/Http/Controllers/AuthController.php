<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogUserInRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name'     => $validatedData['name'],
            'email'    => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role'     => $validatedData['role'],
        ]);
        return response()->json([
            'message' => 'User registered successfully',
            'user'    => new UserResource($user),
        ], 201);
    }

    public function login(LogUserInRequest $request)
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            $user  = auth()->user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token'   => $token,
                'user'    => new UserResource($user),
            ], 200);
        }

        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ], 200);
    }
}
