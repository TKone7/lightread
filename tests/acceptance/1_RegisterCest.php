<?php

use Codeception\Util\Fixtures;

class RegisterCest
{
    public function _before(AcceptanceTester $I)
    {
    }


    public function registerSuccessfully(AcceptanceTester $I)
    {
        $username = 'tester'.random_int(1000,999999);
        $password = bin2hex(random_bytes(20))."!";
        Fixtures::add('newuser', ['username'=>$username, 'password'=>$password]);
        $I->amOnPage('/register');
        $I->see('No account yet? Create one today.');

        $I->amGoingTo('create an account');
        $I->fillField('username',$username);
        $I->fillField('password',$password);
        $I->fillField('passwordrepeat',$password);
        $I->click('Register');

        $I->expect('to see a confirmation and find a db record');
        $I->see('You can login now');
        $I->seeInDatabase('tbl_user', ['fld_user_nickname'=>$username]);
    }

    public function registerAdminSuccessfully(AcceptanceTester $I)
    {
        $username = 'admin'.random_int(1000,999999);
        $password = bin2hex(random_bytes(20))."!";
        Fixtures::add('newadmin', ['username'=>$username, 'password'=>$password]);
        $I->amOnPage('/register');
        $I->see('No account yet? Create one today.');

        $I->amGoingTo('create an account');
        $I->fillField('username',$username);
        $I->fillField('password',$password);
        $I->fillField('passwordrepeat',$password);
        $I->click('Register');

        $I->expect('to see a confirmation and find a db record');
        $I->see('You can login now');
        $I->seeInDatabase('tbl_user', ['fld_user_nickname'=>$username]);
        $I->updateInDatabase('tbl_user', ['fld_user_isadmin'=> true], ['fld_user_nickname' => $username]);

    }

    public function avoidDuplicateRegister(AcceptanceTester $I)
    {
        $newuser = Fixtures::get('newuser');

        $I->amOnPage('/register');
        $I->see('No account yet? Create one today.');
        $I->fillField('username',$newuser['username']);
        $I->fillField('password',$newuser['password']);
        $I->fillField('passwordrepeat',$newuser['password']);
        $I->click('Register');

        $I->see('This username is already chosen.');
    }
}
