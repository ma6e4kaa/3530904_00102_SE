<?php

class ShowplaceCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openListPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/showplace');
        $I->see('Достопримечательности', 'h1');        
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('showplace/create');
        $I->submitForm('#showplace-form', []);
        $I->expectTo('see validations errors');
        $I->see('Добавить достопримечательность', 'h1');
        $I->see('Достопримечательность cannot be blank');
        $I->see('Город cannot be blank');
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('showplace/create');
        $I->submitForm('#showplace-form', [
            'Showplace[showplace]' => 'Достопримечательность',
            'Showplace[city_id]' => '1',
        ]);
        $I->dontSeeElement('#showplace-form');
        $I->see('Достопримечательность', 'h1');
    }
}
