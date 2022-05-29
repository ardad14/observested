<?php

namespace App\Http\Controllers\Api\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AnalyticsController extends Controller
{
    public function showGeneral(int $id): JsonResponse
    {
        $admin = Auth::user();

        $place = Place::findOrFail($id);

        /*$place = Place::whereHas('users', function ($q) use ($admin) {
            $q->where('user_id', $admin['id']);
        })->first();*/

        $allActions = Place::select('*')
            ->where('id', $place->id)
            ->with('customers')
            ->first();

        return response()->json(
            [
                "actions" => $allActions
            ],
            Response::HTTP_OK
        );
    }

    public function getAllProductsForPlace(int $id): JsonResponse
    {
        $admin = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($admin) {
            $q->where('user_id', $admin['id']);
        })->first();

        $products = Product::where('place_id', $place->id)->get();

        return response()->json(
            [
                "products" => $products
            ],
            Response::HTTP_OK
        );
    }
}
