<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PlaceController extends Controller
{
    public function show(int $id): JsonResponse
    {
        $place = Place::findOrFail($id);

        return response()->json(
            [
                "place" => $place
            ],
            Response::HTTP_OK
        );
    }

    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();

        $place = Place::create($request->all());
        $place->users()->save(
            $user,
            [
                'role' => 'admin'
            ]
        );

        return response()->json(
            [
                "created" => true
            ],
            Response::HTTP_OK
        );
    }

    public function update(Request $request, int $id): JsonResponse
    {
        Place::whereId($id)->update($request->all());

        return response()->json(
            [
                "updated" => true
            ],
            Response::HTTP_OK
        );
    }

    public function getPlacesForUser(): JsonResponse
    {
        $user = Auth::user();

        $places = Place::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user['id']);
        })->get();

        return response()->json(
            [
                "places" => $places
            ],
            Response::HTTP_OK
        );
    }

    public function getFirstPlaceForUser(): JsonResponse
    {
        $user = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user['id']);
        })->first();

        return response()->json(
            [
                "place" => $place
            ],
            Response::HTTP_OK
        );
    }
}
