<?php

namespace App\Http\Controllers\Api\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class AnalyticsController extends Controller
{
    public function showGeneral(int $id): Response
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

        return response($allActions);
    }

    public function getAllProductsForPlace(int $id): Response
    {
        $admin = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($admin) {
            $q->where('user_id', $admin['id']);
        })->first();

        $products = Product::where('place_id', $place->id)->get();

        return response($products);
    }
}
