<?php

namespace tests\api;

use ApiTester;
use App\Models\User;
use Laravel\Passport\Passport;

class CustomerCest
{
    public function testGetCustomersForPlaceSuccess(ApiTester $I): void
    {
        $user = User::find(1);
        Passport::actingAs($user);
        $token = $user->token();
        $I->amBearerAuthenticated($token);

        $I->sendGet('/customers/place');
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    public function testGetCustomersForPlaceFailed(ApiTester $I): void
    {
        $I->sendGet('/analytics/general/1');
        $I->canSeeResponseCodeIs(405);
        //print_r("\n" . $I->grabResponse());
    }
}
