<?php

namespace tests\api;

use ApiTester;
use App\Models\Place;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;

class PlaceCest
{
    private $faker;

    /**
     * @param $faker
     */
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function testGetPlacesSuccess(ApiTester $I): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $token = $user->token();
        $I->amBearerAuthenticated($token);

        $I->sendGet('/place/show/1');
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    public function testGetPlacesFailed(ApiTester $I): void
    {
        $I->sendGet('/place/show/1');
        $I->canSeeResponseCodeIs(405);
        //print_r("\n" . $I->grabResponse());
    }

    public function testCreatePlacesSuccess(ApiTester $I): void
    {
        $user = User::find(1);
        Passport::actingAs($user);
        $token = $user->token();
        $I->amBearerAuthenticated($token);

        $I->sendPost('/place', [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'working_hours_start' => '08:00',
            'working_hours_end' => '19:00',
        ]);
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    public function testCreatePlacesFailed(ApiTester $I): void
    {
        $I->sendPost('/place', [
            'data' => 'data'
        ]);
        $I->canSeeResponseCodeIs(405);
        //print_r("\n" . $I->grabResponse());
    }

    public function testUpdatePlacesSuccess(ApiTester $I): void
    {
        $user = User::find(1);
        Passport::actingAs($user);
        $token = $user->token();
        $I->amBearerAuthenticated($token);

        $I->sendPut('/place/1', [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'working_hours_start' => '08:00',
            'working_hours_end' => '19:00',
        ]);
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    public function testUpdatePlacesFailed(ApiTester $I): void
    {
        $I->sendPost('/place/1', [
            'data' => 'data'
        ]);
        $I->canSeeResponseCodeIs(405);
        //print_r("\n" . $I->grabResponse());
    }

    public function testGetPlacesForUserSuccess(ApiTester $I): void
    {
        $user = User::find(1);
        Passport::actingAs($user);
        $token = $user->token();
        $I->amBearerAuthenticated($token);

        $I->sendGet('/place/places');
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    public function testGetPlacesForUserFailed(ApiTester $I): void
    {
        $I->sendPost('/place/places', [
            'data' => 'data'
        ]);
        $I->canSeeResponseCodeIs(405);
        //print_r("\n" . $I->grabResponse());
    }

    public function testGetFirstPlaceForUserSuccess(ApiTester $I): void
    {
        $user = User::find(1);
        Passport::actingAs($user);
        $token = $user->token();
        $I->amBearerAuthenticated($token);

        $I->sendGet('/place/first');
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    public function testGetFirstPlaceForUserFailed(ApiTester $I): void
    {
        $I->sendPost('/place/first', [
            'data' => 'data'
        ]);
        $I->canSeeResponseCodeIs(405);
        //print_r("\n" . $I->grabResponse());
    }

}
