<?php

class GoodsCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openListPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/goods');
        $I->see('Товары', 'h1');        
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('goods/create');
        $I->submitForm('#goods-form', []);
        $I->expectTo('see validations errors');
        $I->see('Добавить товар', 'h1');
        $I->see('Наименование cannot be blank');
        $I->see('Цена cannot be blank');
        $I->see('Кол-во cannot be blank');
    }

    public function submitFormWithIncorrectData(\FunctionalTester $I)
    {
        $I->amOnRoute('goods/create');
        $I->submitForm('#goods-form', [
            'Goods[name]' => 'Веер',
            'Goods[cost]' => 'цена',
            'Goods[quantity]' => 'кол-во',
        ]);
        $I->expectTo('see that cost and quantity are wrong');
        $I->dontSee('Наименование cannot be blank', '.help-inline');
        $I->see('Кол-во must be an integer.');       
        $I->see('Цена must be an integer.');       
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('goods/create');
        $I->submitForm('#goods-form', [
            'Goods[name]' => 'Веер',
            'Goods[cost]' => '100',
            'Goods[quantity]' => '2',
        ]);
        $I->dontSeeElement('#goods-form');
        $I->see('Веер', 'h1');
    }
}
