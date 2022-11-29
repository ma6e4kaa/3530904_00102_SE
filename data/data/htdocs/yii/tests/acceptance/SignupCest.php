<?php

use yii\helpers\Url;

class SignupCest
{
    public function _before(\AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/signup'));
    }
    
    public function signupPageWorks(AcceptanceTester $I)
    {
        $I->wantTo('ensure that signup page works');
        $I->see('Регистрация', 'h1');
    }

    public function signupFormCanBeSubmitted(AcceptanceTester $I)
    {
        $I->amGoingTo('submit signup form with correct data');
        $I->fillField('#signup-form-user-username', 'tester');
        $I->fillField('#signup-form-pass', 'tester');
        $I->fillField('#signup-form-confpass', 'tester');
        $I->wait(2);

        $I->click('btn');
        
        $I->wait(2); // wait for button to be clicked

        $I->dontSeeElement('#signup-form');
        $I->see('Вход', 'h1');
    }
}
