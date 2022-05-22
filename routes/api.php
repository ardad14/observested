<?php

use App\Http\Controllers\Api\Analytics\AnalyticsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'analytics', 'middleware' => 'auth:api'], function () {
    Route::get('/general', [AnalyticsController::class, 'showGeneral']);
    Route::get('/products', [AnalyticsController::class, 'getAllProductsForPlace']);
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:api'], function () {
    Route::get('/place', [UserController::class, 'usersForPlace']);
});

Route::group(['prefix' => 'customers', 'middleware' => 'auth:api'], function () {
    Route::get('/place', [CustomerController::class, 'customersForPlace']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
