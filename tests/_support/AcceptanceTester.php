<?php

use Codeception\Util\Fixtures;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

   /**
    * Define custom actions here
    */
   public function amLoggedIn($username, $pw)
   {
       $I = $this;

       if (Fixtures::exists($username)) {
           // get data from registry
           $storedUserData = Fixtures::get($username);
           $newAccessToken = $storedUserData['token'];
       }
       else {
           // no registry data - log in and save data in registry
           $I->tryToLogin($username, $pw);

           $newAccessToken = $I->grabCookie('token');
           Fixtures::add($username, ['token' => $newAccessToken]);

       }
       $I->setCookie('token',$newAccessToken, ["domain"=>"", "path"=>"/","secure"=>false,"expires"=>(new \DateTime('now'))->modify('+30 days')->getTimestamp()]);
   }

   public function tryToLogin($user, $password)
   {
       $I = $this;

       $I->amGoingTo('login as the AcceptanceTester');

       $I->amOnPage('/login');
       $I->fillField('email',$user);
       $I->fillField('password',$password);
       $I->checkOption('#customCheck1');
       $I->click('Sign in');

       $I->expect('to be logged in and get a cookie to remember my login');

       $I->see('Your profile');
       $I->see('Your articles');
       $I->seeCookie('token');
       $I->dontSee('Login was not successful');
   }

}
