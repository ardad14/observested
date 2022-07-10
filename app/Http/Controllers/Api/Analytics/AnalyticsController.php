<?php

namespace App\Http\Controllers\Api\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Product;
use App\Services\AnalyticsService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class AnalyticsController extends Controller
{
    public function showGeneral(int $id, AnalyticsService $analyticsService): Response
    {
        return response($analyticsService->showGeneral($id));
    }

    public function getAllProductsForPlace(int $id, AnalyticsService $analyticsService): Response
    {
        return response($analyticsService->getAllProductsForPlace($id));
    }
}
