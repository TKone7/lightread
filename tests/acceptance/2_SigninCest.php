<?php

use Codeception\Util\Fixtures;

class SigninCest
{
    private $newuser;

    public function _before(AcceptanceTester $I)
    {
        $this->newuser = Fixtures::get('newuser');
        $I->amLoggedIn($this->newuser['username'],$this->newuser['password']);

    }

    // tests
    public function signInSuccessfully(AcceptanceTester $I)
    {
        $I->amOnPage('/profile');
        $I->see('Your profile');

    }

    public function accessEditProfile(AcceptanceTester $I)
    {
        $I->amOnPage('/profile');
        $I->click('Edit profile / Change password');
        $I->makeHtmlSnapshot('edit');

        $I->see('Edit Profile');

        $I->seeInField('username', $this->newuser['username']);

    }


/*
    public function signInWrongPassword(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->fillField('email','AcceptanceTester');
        $I->fillField('password','AcceptanceTester!asdf');
        $I->click('Sign in');
        $I->see('Login was not successful. Please try again.');
    }
*/

}
