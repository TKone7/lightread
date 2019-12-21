<?php

use Codeception\Util\Fixtures;

class NodeCest
{
    private $newuser;

    public function _before(AcceptanceTester $I)
    {
        $this->newuser = Fixtures::get('newadmin');
        $I->amLoggedIn($this->newuser['username'],$this->newuser['password']);
    }

    // tests
    public function showNodeInfo(AcceptanceTester $I)
    {
        $I->amOnPage('/node');
        $I->see('Online');
    }
    public function hideNodeInfoNotAdmin(AcceptanceTester $I)
    {
        $I->amGoingTo('login as normal user');
        $this->newuser = Fixtures::get('newuser');
        $I->amLoggedIn($this->newuser['username'],$this->newuser['password']);
        $I->amOnPage('/node');
        $I->expect('the node to be hidden from me.');
        $I->dontSee('Online');
    }
}
