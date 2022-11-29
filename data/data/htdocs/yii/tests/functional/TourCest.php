<?php

class TourCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openListPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/tour');
        $I->see('Туры', 'h1');        
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('tour/create');
        $I->submitForm('#tour-form', []);
        $I->expectTo('see validations errors');
        $I->see('Добавить тур', 'h1');
        $I->see('Название cannot be blank');
        $I->see('Время начала cannot be blank');
        $I->see('Время окончания cannot be blank');
        $I->see('Цена cannot be blank');
    }

    public function submitFormStationSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('tour/create');
        $I->submitForm('#tour-form', [
            'Tour[name]' => 'Название',
            'Tour[start_time]' => '10:00',
            'Tour[end_time]' => '20:00',
            'Tour[price]' => '5000',
        ]);
        $I->dontSeeElement('#tour-form');
        $I->see('Название', 'h1');
        $I->click('#btn1');
        $I->see('Добавить остановку', 'h1');
        $I->submitForm('#station-form', []);
        $I->expectTo('see validations errors');
        $I->see('Добавить остановку', 'h1');
        $I->see('Время остановки cannot be blank');
        $I->submitForm('#station-form', [
            'TourStation[time_stop]' => '12:00',
            'TourStation[showplace]' => '1',
            'TourStation[station]' => 'Station',
        ]);
        $I->dontSeeElement('#station-form');
        $I->see('Остановка тура 12:00:00', 'h1');
    }
    
    public function submitFormDateSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('tour/create');
        $I->submitForm('#tour-form', [
            'Tour[name]' => 'Название',
            'Tour[start_time]' => '10:00',
            'Tour[end_time]' => '20:00',
            'Tour[price]' => '5000',
        ]);
        $I->dontSeeElement('#tour-form');
        $I->see('Название', 'h1');
        $I->click('#btn2');
        $I->see('Добавить дату тура', 'h1');
        $I->submitForm('#date-form', []);
        $I->expectTo('see validations errors');
        $I->see('Добавить дату тура', 'h1');
        $I->see('Статус cannot be blank');
        $I->see('Места cannot be blank');
        $I->submitForm('#date-form', [
            'TourDate[date_tour]' => '2022-12-12',
            'TourDate[seats]' => '1',
            'TourDate[status]' => '1',
            'TourDate[guide]' => '3',
        ]);
        $I->dontSeeElement('#date-form');
        $I->see('Дата тура "Название" 12.12.2022', 'h1');
    }
}
