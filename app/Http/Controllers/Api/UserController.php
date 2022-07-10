<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function getUsersForPlace(UserService $userService): Response
    {
        return response($userService->getUsersForPlace());
    }
}
