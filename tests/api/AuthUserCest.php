<?php

namespace tests\api;

use ApiTester;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;
use Faker\Generator;
use Laravel\Passport\Passport;

class AuthUserCest
{
    private $faker;

    /**
     * @param $faker
     */
    public function __construct()
    {
        $this->faker = Factory::create();
    }


    public function testLoginSuccess(ApiTester $I): void
    {
       $I->sendPost('/login', [
            'email' => 'kuptsov210@gmail.com',
            'password' => 'qwerty',
        ]);
        $I->seeResponseContainsJson([
            'userId' => 1,
            'role' => 'admin',
        ]);
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    public function testLoginFailed(ApiTester $I): void
    {
        $I->sendPost('/login', [
            'email' => 'kuptsov210@gmail.com',
            'password' => 'asdasdad',
        ]);
        $I->seeResponseContainsJson([
            'message' => 'You cannot sign with those credentials',
            'errors' => 'Unauthorised',
        ]);
        $I->canSeeResponseCodeIs(401);
        //print_r("\n" . $I->grabResponse());
    }

    public function testRegisterSuccess(ApiTester $I): void
    {
        $I->sendPost('/register', [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => 'qwerty',
            'role' => 'admin',
        ]);
        $I->seeResponseContainsJson([
            'message' => 'You were successfully registered. Use your email and password to sign in.',
        ]);
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }

    /*public function testRegisterFailed(ApiTester $I): void
    {
        $I->sendPost('/register', [
            'name' => '',
            'surname' => '',
            'email' => '',
            'password' => '',
            'role' => '',
        ]);
        $I->canSeeResponseCodeIs(404);
        print('wiefjwe');
    }*/

    public function testLogoutSuccess(ApiTester $I): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $token = $user->token();
        $I->amBearerAuthenticated($token);

        $I->sendPost('/logout', [
            'data' => 'data'
        ]);
        $I->seeResponseContainsJson([
            'message' => 'You are successfully logged out',
        ]);
        $I->canSeeResponseCodeIs(200);
        //print_r("\n" . $I->grabResponse());
    }
}
