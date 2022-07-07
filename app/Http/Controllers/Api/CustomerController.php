<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Place;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customersForPlace(): Response
    {
        $admin = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($admin) {
            $q->where('user_id', $admin['id']);
        })->first();

        $customersPlace = Customer::whereHas('places', function ($q) use ($place) {
            $q->where('place_id', $place->id);
        })->get();

        return response($customersPlace);
    }
}
