<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PlaceController extends Controller
{
    public function show(Place $place): Response
    {
        return response(["place" => $place]);
    }

    public function store(Request $request): Response
    {
        $user = Auth::user();

        $place = Place::create($request->all());
        $place->users()->save(
            $user,
            [
                'role' => 'admin'
            ]
        );

        return response(["created" => true]);
    }

    public function update(Request $request, Place $place): Response
    {
        $place->update($request->all());
        return response(["updated" => true]);
    }

    public function delete(Place $place): Response
    {
        Place::destroy($place->id);
        return response(['delete' => true]);
    }

    public function getPlacesForUser(): Response
    {
        $user = Auth::user();

        $places = Place::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user['id']);
        })->get();

        return response(["places" => $places]);
    }

    public function getFirstPlaceForUser(): Response
    {
        $user = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user['id']);
        })->first();

        return response(["place" => $place]);
    }
}
