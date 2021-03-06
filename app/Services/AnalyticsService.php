<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    public static function getAllActionsForPlace(): string
    {
        $admin = User::find(session()->get('userId'));
        $place = DB::table('users_places')
            ->where('user_id', $admin->id)
            ->first();

        $actions =  DB::select('select
                                    clients_places.id,
                                    clients_places.client_id,
                                    clients_places.place_id,
                                    clients_places.spend_money,
                                    clients_places.created_at,
                                    clients.id,
                                    clients.age
                                from clients_places, clients
                                where clients_places.place_id = ? and clients.id = clients_places.client_id',
            [$place->place_id]
        );

        return json_encode($actions);
    }

    public static function getAllProductsForPlace(): bool|string
    {
        $admin = User::find(session()->get('userId'));
        $place = DB::table('users_places')
            ->where('user_id', $admin->id)
            ->first();
        $products =  json_encode(DB::table('products')
            ->where('place_id', $place->place_id)
            ->get());
        return $products;
    }
}
