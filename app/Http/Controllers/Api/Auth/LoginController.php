<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $token = Auth::user()->createToken(config('app.name'));

        $token->token->expires_at = $request->remember_me ?
            Carbon::now()->addMonth() :
            Carbon::now()->addDay();

        $token->token->save();

        return response()->json([
            'user' => Auth::user(),
            'token' => $token->accessToken,
        ], 200);
    }
}
