<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $user = User::create(array_merge(
            $request->except('password'),
            ['password' => bcrypt($request->password)],
        ));

        return response()->json([
            'message' => 'You were successfully registered. Use your email and password to sign in.'
        ], 200);
    }
}
