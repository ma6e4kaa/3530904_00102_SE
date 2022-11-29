<?php

class TourStatusCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openListPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/tour-status');
        $I->see('Статусы тура', 'h1');        
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('tour-status/create');
        $I->submitForm('#tour-status-form', []);
        $I->expectTo('see validations errors');
        $I->see('Добавить статус тура', 'h1');
        $I->see('Статус cannot be blank');
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('tour-status/create');
        $I->submitForm('#tour-status-form', [
            'TourStatus[tour_status]' => 'Статус',
        ]);
        $I->dontSeeElement('#tour-status-form');
        $I->see('Статусы тура', 'h1');
    }
}
