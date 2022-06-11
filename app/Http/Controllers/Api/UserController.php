<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getUsersForPlace(): JsonResponse
    {
        $admin = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($admin) {
            $q->where('user_id', $admin['id']);
        })->first();

        $userPlace = User::whereHas('places', function ($q) use ($place) {
            $q->where('place_id', $place->id);
        })->get();

        return response()->json(
            [
                "users" => $userPlace
            ],
            Response::HTTP_OK
        );
    }
}
