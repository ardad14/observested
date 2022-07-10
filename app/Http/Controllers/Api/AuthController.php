<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class AuthController extends Controller
{
    public function register(RegisterFormRequest $request, UserService $userService): Response
    {
        return response($userService->register($request));
    }

    public function login(LoginRequest $request, UserService $userService): Response
    {
        $result = $userService->login($request);
        return response($result, $result['code']);
    }

    public function logout(Request $request, UserService $userService): Response
    {
        return response($userService->logout($request));
    }
}
