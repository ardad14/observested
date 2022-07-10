<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreatePlaceRequest;
use App\Http\Requests\Api\UpdatePlaceRequest;
use App\Models\Place;
use App\Services\PlaceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class PlaceController extends Controller
{
    public function show(Place $place, PlaceService $placeService): Response
    {
        return response($placeService->show($place));
    }

    public function store(CreatePlaceRequest $request, PlaceService $placeService): Response
    {
        return response($placeService->store($request));
    }

    public function update(UpdatePlaceRequest $request, Place $place, PlaceService $placeService): Response
    {
        return response($placeService->update($request, $place));
    }

    public function delete(Place $place, PlaceService $placeService): Response
    {
        return response($placeService->delete($place));
    }

    public function getPlacesForUser(PlaceService $placeService): Response
    {
        return response($placeService->getPlacesForUser());
    }

    public function getFirstPlaceForUser(PlaceService $placeService): Response
    {
        return response($placeService->getFirstPlaceForUser());
    }
}
