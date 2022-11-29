<?php

class CityCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openListPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/city');
        $I->see('Города', 'h1');        
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('city/create');
        $I->submitForm('#city-form', []);
        $I->expectTo('see validations errors');
        $I->see('Добавить город', 'h1');
        $I->see('Город cannot be blank');
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('city/create');
        $I->submitForm('#city-form', [
            'City[city]' => 'Город',
        ]);
        $I->dontSeeElement('#city-form');
        $I->see('Города', 'h1');
    }
}
