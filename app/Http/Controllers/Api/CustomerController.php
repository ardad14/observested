<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function customersForPlace(): JsonResponse
    {
        $admin = Auth::user();

        $place = Place::whereHas('users', function ($q) use ($admin) {
            $q->where('user_id', $admin['id']);
        })->first();

        $customersPlace = Customer::whereHas('places', function ($q) use ($place) {
            $q->where('place_id', $place->id);
        })->get();

        return response()->json(
            [
                "customers" => $customersPlace
            ],
            Response::HTTP_OK
        );
    }
}
