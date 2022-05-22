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
    public function usersForPlace(): JsonResponse
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

    /*public static function addWorker(Request $request)
    {
        $userByEmail = User::where('email', $request['email'])->first();
        $admin = User::find(session()->get('userId'));
        $place = DB::table('users_places')
            ->where('user_id', $admin->id)
            ->first();

        if ($userByEmail !== null) {
            DB::table("users_places")->insert([
                'user_id' => $userByEmail->id,
                'place_id' => $place->place_id,
                'role' => $request['role']
            ]);

        }
        header('location: /workers');
        return true;
    }*/
}
