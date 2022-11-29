<?php

use yii\helpers\Url;

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));        
        $I->see('Туристическое агенство FunTravel', 'h2');
        
        $I->seeLink('Туры');
        $I->click('Туры');
        $I->wait(2); // wait for page to be opened
        
        $I->see('Туры');
    }
}
