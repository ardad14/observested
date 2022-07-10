<?php

namespace App\Services;

use App\Models\Place;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    public function showGeneral(int $id)
    {
        $admin = Auth::user();

        $place = Place::findOrFail($id);

        $allActions = Place::select('*')
            ->where('id', $place->id)
            ->with('customers')
            ->first();

        return $allActions;
    }

    public function getAllProductsForPlace(int $id)
    {
        $admin = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($admin) {
            $q->where('user_id', $admin['id']);
        })->first();

        $products = Product::where('place_id', $place->id)->get();

        return $products;
    }
}
