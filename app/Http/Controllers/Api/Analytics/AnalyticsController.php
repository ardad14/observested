<?php

namespace App\Http\Controllers\Api\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AnalyticsController extends Controller
{
    public function showGeneral(Request $request)
    {
        $admin = Auth::user();

        $place = Place::whereHas('users', function($q) use($admin) {
            $q->where('user_id', $admin['id']);
        })->first();

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
}
