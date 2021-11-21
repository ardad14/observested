<?php

use Illuminate\Support\Facades\Route;

use App\Models\Client;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ClientController;

use App\Services\UserService;
use App\Services\PlaceService;
use App\Services\AnalyticsService;
use App\Services\ClientService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Analytics Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('main'));

Route::get('/analytics/general', fn() => view('analyticsGeneral', [
    'actions' => AnalyticsService::getAllActionsForPlace(),
]));

Route::get('/analytics/month', fn() => view('analyticsMonth', [
    'actions' => AnalyticsService::getAllActionsForPlace(),
]));

Route::get('/analytics/clients', fn() => view('analyticsClients', [
    'actions' => AnalyticsService::getAllActionsForPlace(),
]));

Route::get('/analytics/goods', fn() => view('analyticsGoods', [
    'actions' => AnalyticsService::getAllProductsForPlace(),
]));


Route::get('/clients', fn() => view('clients' , [
    'clients' => ClientService::getClientsForPlace(),
]));

Route::get('/editClient/{id}', fn($id) => view('editClient' , [
    'client' => Client::find($id),
]));

Route::post(
    '/editClientService/{id}',
    [ClientController::class, 'editClient']
);

Route::get('/workers', fn() => view('workers', [
    'workers' => UserService::getWorkersForPlace()
]));

Route::get('/addWorker', fn() => view('addWorker'));

Route::post(
    '/addWorkerService',
    [UserController::class, 'addWorker']
);

Route::get('/createPlace', fn() => view('createPlace'));

Route::post(
    '/createPlaceService',
    [PlaceController::class, 'createPlace']
);



/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
*/

Route::get('/signUp', fn() => view('signUp'));

Route::post(
    '/signUpService',
    [UserController::class, 'signUp']
)->name('signUp');

Route::get('/signIn', fn() => view('signIn', [
    'allPlaces' => PlaceService::getAllPlaces()
]));

Route::post(
    '/signInService',
    [UserController::class, 'signIn']
)->name('signIn');

Route::get(
    '/logOut',
    [UserController::class, 'logOut']
)->name('logOut');
