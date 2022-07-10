<?php

namespace App\Services;

use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getUsersForPlace()
    {
        $admin = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($admin) {
            $q->where('user_id', $admin['id']);
        })->first();

        $userPlace = User::whereHas('places', function ($q) use ($place) {
            $q->where('place_id', $place->id);
        })->get();

        return $userPlace;
    }

    public function register(RegisterFormRequest $request): array
    {
        $user = User::create(array_merge(
            $request->only('name', 'surname', 'email', 'phone'),
            ['password' => bcrypt($request->password)],
        ));

        return [
            'message' => 'You were successfully registered. Use your email and password to sign in.'
        ];
    }

    public function login(LoginRequest $request): array
    {
        $user = $request->all();
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return [
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised',
                'code' => 401,
            ];
        }

        $token = Auth::user()->createToken(config('app.name'));

        $token->token->expires_at = Carbon::now()->addDay();
        $token->token->save();

        $user = Auth::user();

        return [
            'userId' => Auth::id(),
            'role' => $user->role,
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
            'code' => 200,
        ];
    }

    public function logout(Request $request): array
    {
        $request->user()->token()->revoke();

        return [
            'message' => 'You are successfully logged out',
        ];
    }
}
