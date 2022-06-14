<?php

namespace tests\api;

use ApiTester;
use App\Models\User;
use Laravel\Passport\Passport;

class AnalyticsCest
{
    public function testGetGeneralAnalyticsSuccess(ApiTester $I): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $token = $user->token();
        $I->amBearerAuthenticated($token);

        $I->sendGet('/analytics/general/1');
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    public function testGetGeneralAnalyticsFailed(ApiTester $I): void
    {
        $I->sendGet('/analytics/general/1');
        $I->canSeeResponseCodeIs(405);
        //print_r("\n" . $I->grabResponse());
    }

    public function testGetProductsAnalyticsSuccess(ApiTester $I): void
    {
        $user = User::find(1);
        Passport::actingAs($user);
        $token = $user->token();
        $I->amBearerAuthenticated($token);

        $I->sendGet('/analytics/products/1');
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    public function testGetProductsAnalyticsFailed(ApiTester $I): void
    {
        $I->sendGet('/analytics/products/1');
        $I->canSeeResponseCodeIs(405);
        //print_r("\n" . $I->grabResponse());
    }
}
