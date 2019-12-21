<?php

use Codeception\Util\Fixtures;

class ProfileCest
{
    private $newuser;

    public function _before(AcceptanceTester $I)
    {
        $this->newuser = Fixtures::get('newuser');
        $I->amLoggedIn($this->newuser['username'],$this->newuser['password']);

    }

    // tests
    public function updateName(AcceptanceTester $I)
    {
        $first = 'Acceptance';
        $last = 'Tester';
        $I->amOnPage('/profile');
        $I->see('Your profile');
        $I->click('Edit profile / Change password');
        $I->fillField('firstname',$first);
        $I->fillField('lastname',$last);
        $I->click('Save changes');
        $I->see($first. " " .$last);
    }

    public function updateEmail(AcceptanceTester $I)
    {

        $email = $this->newuser['username'].'@gmail.com';
        $I->amOnPage('/profile');
        $I->see('Your profile');
        $I->click('Edit profile / Change password');
        $I->fillField('email',$email);
        $I->click('Save changes');
        $I->see($email);
        $I->see('Your e-mail address is unverified. Please check the e-mail we sent you.');
    }
    public function verifyEmail(AcceptanceTester $I){

        $I->amOnPage('/profile');
        $I->see('Your e-mail address is unverified. Please check the e-mail we sent you.');
        $I->updateInDatabase('tbl_user', ['fld_user_verified'=> true], ['fld_user_nickname' => $this->newuser['username']]);
        $I->amOnPage('/profile');
        $I->dontSee('Your e-mail address is unverified. Please check the e-mail we sent you.');
    }


}
