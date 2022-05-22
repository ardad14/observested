<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Place;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Place::factory()
            ->count(10)
            ->create();

        User::factory()
            ->count(10)
            ->create();

        Customer::factory()
            ->count(150)
            ->create();

        Product::factory()
            ->count(80)
            ->create();

        $customers = Customer::all();
        $users = User::all();
        $places = Place::all();

        //Generate customers_places relation table
        $customers->each(function ($customer) use ($places) {
            $customer->places()->attach(
                $places->random(rand(1, 10))->pluck('id')->toArray(),
                [
                    'spend_money' => rand(100, 10000),
                    'created_at' => Carbon::today()->subDays(rand(0, 365)),
                ]
            );
        });

        //Generate users_places relation table
        $users->each(function ($user) use ($places) {
            $user->places()->attach(
                $places->random(rand(1, 10))->pluck('id')->toArray(),
                ['role' => $user->role]
            );
        });
    }
}
