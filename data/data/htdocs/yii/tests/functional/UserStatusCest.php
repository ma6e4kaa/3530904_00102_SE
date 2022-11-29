<?php

class UserStatusCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openListPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/user-status');
        $I->see('Статусы пользователя', 'h1');        
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('user-status/create');
        $I->submitForm('#user-status-form', []);
        $I->expectTo('see validations errors');
        $I->see('Добавить статус', 'h1');
        $I->see('Статус пользователя cannot be blank');
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('user-status/create');
        $I->submitForm('#user-status-form', [
            'UserStatus[status]' => 'Статус',
        ]);
        $I->dontSeeElement('#user-status-form');
        $I->see('Статусы пользователя', 'h1');
    }
}
