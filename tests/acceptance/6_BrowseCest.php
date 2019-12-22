<?php 

class BrowseCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function visitAbout(AcceptanceTester $I)
    {
        $I->amOnPage('/about');
        $I->see('Solution');

    }
    public function visitCategory(AcceptanceTester $I)
    {
        $I->amOnPage('/category');
        $I->see('Find what you are looking for');

    }
    public function visit404(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->amOnPage('/asdfasdfasdf');
        $I->see('page not found');

    }
}
