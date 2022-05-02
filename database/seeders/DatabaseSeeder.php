<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\ClientPlaces;
use App\Models\Place;
use App\Models\Product;
use App\Models\User;
use App\Models\UserPlaces;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*Place::factory()
            ->count(10)
            ->create();*/


        /*User::factory()
            ->count(10)
            ->create();

        Customer::factory()
            ->count(150)
            ->create();

        ClientPlaces::factory()
            ->count(500)
            ->create();

        UserPlaces::factory()
            ->count(12)
            ->create();*/

        Product::factory()
            ->count(80)
            ->create();
    }
}
