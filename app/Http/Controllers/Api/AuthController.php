<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
        $user = User::create(array_merge(
            $request->only('name', 'surname', 'email', 'phone'),
            ['password' => bcrypt($request->password)],
        ));

        return response([
            'message' => 'You were successfully registered. Use your email and password to sign in.'
        ]);
    }

    public function login(LoginRequest $request)
    {
        $user = $request->all();
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $token = Auth::user()->createToken(config('app.name'));

        $token->token->expires_at = Carbon::now()->addDay();
        $token->token->save();

        $user = Auth::user();

        return response()->json([
            'userId' => Auth::id(),
            'role' => $user->role,
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'You are successfully logged out',
        ]);
    }
}
