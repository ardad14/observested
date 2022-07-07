<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUsersForPlace(): Response
    {
        $admin = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($admin) {
            $q->where('user_id', $admin['id']);
        })->first();

        $userPlace = User::whereHas('places', function ($q) use ($place) {
            $q->where('place_id', $place->id);
        })->get();

        return response($userPlace);
    }
}
