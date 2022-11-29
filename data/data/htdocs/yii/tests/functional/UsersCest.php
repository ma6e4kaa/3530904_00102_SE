<?php

class UsersCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openEditPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/users/create');
        $I->see('Создать пользователя', 'h1');        
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('users/create');
        $I->submitForm('#users-form', [
            'User[username]' => 'username',
            'User[password]' => 'username',
            'User[passwd]' => 'username',
        ]);
        $I->dontSeeElement('#users-form');
        $I->see('Пользователи', 'h1');
    }
}
