<?php

namespace App\Services;

use App\Http\Requests\Api\CreatePlaceRequest;
use App\Http\Requests\Api\UpdatePlaceRequest;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaceService
{
    public function show(Place $place)
    {
        return $place;
    }

    public function store(CreatePlaceRequest $request)
    {
        $user = Auth::user();

        $place = Place::create($request->all());
        $place->users()->save(
            $user,
            [
                'role' => 'admin'
            ]
        );

        return ["created" => true];
    }

    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $place->update($request->all());
        return ["updated" => true];
    }

    public function delete(Place $place)
    {
        Place::destroy($place->id);
        return ['delete' => true];
    }

    public function getPlacesForUser()
    {
        $user = Auth::user();

        $places = Place::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user['id']);
        })->get();

        return $places;
    }

    public function getFirstPlaceForUser()
    {
        $user = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user['id']);
        })->first();

        return $place;
    }

}
