<?php

use App\Models\User;
use Laravel\Passport\Passport;

class UserCest
{
    public function testGetFirstPlaceForUserSuccess(ApiTester $I): void
    {
        $user = User::find(1);
        Passport::actingAs($user);
        $token = $user->token();
        $I->amBearerAuthenticated($token);

        $I->sendGet('/users/place');
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    public function testGetFirstPlaceForUserFailed(ApiTester $I): void
    {
        $I->sendPost('/users/place', [
            'data' => 'data'
        ]);
        $I->canSeeResponseCodeIs(405);
        //print_r("\n" . $I->grabResponse());
    }
}
