<?php

class TicketsCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openListPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/tickets');
        $I->see('Билеты', 'h1');        
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('tickets/create');
        $I->submitForm('#tickets-form', []);
        $I->expectTo('see validations errors');
        $I->see('Добавить билет', 'h1');
        $I->see('Дата тура cannot be blank');
        $I->see('Статус билета cannot be blank');
        $I->see('Гость cannot be blank');
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('tickets/create');
        $I->submitForm('#tickets-form', [
            'Tickets[tour_id]' => '2',
            'Tickets[tour_date_id]' => '3',
            'Tickets[guest_id]' => '15',
            'Tickets[status]' => '1',
        ]);
        $I->dontSeeElement('#tickets-form');
        $I->see('Билет на дату', 'h1');
    }
}
