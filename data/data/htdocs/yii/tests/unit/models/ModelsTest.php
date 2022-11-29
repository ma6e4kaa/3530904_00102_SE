<?php

namespace tests\unit\models;

use app\models\City;
use app\models\Feedback;
use app\models\Goods;
use app\models\Role;
use app\models\Sales;
use app\models\SalesDetails;
use app\models\Showplace;
use app\models\Tickets;
use app\models\Tour;
use app\models\TourDate;
use app\models\TourStation;
use app\models\TourStatus;
use app\models\UserAttr;
use app\models\UserStatus;

class ModelsTest extends \Codeception\Test\Unit
{
    public function testFindCityById()
    {
        verify($city = City::findOne(['id' => 2]))->notEmpty();
        verify($city->city)->equals('Москва');

        verify(City::findOne(['id' => 999]))->empty();
    }
    
    public function testFindFeedbackById()
    {
        verify($feedback = Feedback::findOne(['id' => 1]))->notEmpty();
        verify($feedback->ball)->equals('5');

        verify(Feedback::findOne(['id' => 999]))->empty();
    }
    
    public function testFindGoodById()
    {
        verify($good = Goods::findOne(['id' => 1]))->notEmpty();
        verify($good->name)->equals('Магнит Дворцовый мост');

        verify(Goods::findOne(['id' => 999]))->empty();
    }
    
    public function testFindRoleById()
    {
        verify($role = Role::findOne(['id' => 1]))->notEmpty();
        verify($role->role)->equals('Пользователь');

        verify(Role::findOne(['id' => 999]))->empty();
    }
    
    public function testFindSaleById()
    {
        verify($sale = Sales::findOne(['id' => 1]))->notEmpty();
        verify($sale->ticket_id)->equals('1');

        verify(Sales::findOne(['id' => 999]))->empty();
    }
    
    public function testFindSalesDetailById()
    {
        verify($sales_detail = SalesDetails::findOne(['id' => 5]))->notEmpty();
        verify($sales_detail->quantity)->equals('3');

        verify(SalesDetails::findOne(['id' => 999]))->empty();
    }
    
    public function testFindShowplaceById()
    {
        verify($showplace = Showplace::findOne(['id' => 1]))->notEmpty();
        verify($showplace->showplace)->equals('Эрмитаж');

        verify(Showplace::findOne(['id' => 999]))->empty();
    }
    
    public function testFindTicketById()
    {
        verify($ticket = Tickets::findOne(['id' => 1]))->notEmpty();
        verify($ticket->guest_id)->equals('14');

        verify(Tickets::findOne(['id' => 999]))->empty();
    }
    
    public function testFindTourById()
    {
        verify($tour = Tour::findOne(['id' => 1]))->notEmpty();
        verify($tour->name)->equals('Санкт-Петербургские музеи');

        verify(Tour::findOne(['id' => 999]))->empty();
    }
    
    public function testFindTourDateById()
    {
        verify($tour_date = TourDate::findOne(['id' => 1]))->notEmpty();
        verify($tour_date->date_tour)->equals('2022-11-16');

        verify(TourDate::findOne(['id' => 999]))->empty();
    }
    
    public function testFindTourStationById()
    {
        verify($station = TourStation::findOne(['id' => 1]))->notEmpty();
        verify($station->time_stop)->equals('10:00:00');

        verify(TourStation::findOne(['id' => 999]))->empty();
    }
    
    public function testFindTourStatusById()
    {
        verify($status = TourStatus::findOne(['id' => 1]))->notEmpty();
        verify($status->tour_status)->equals('Ожидает начала');

        verify(TourStatus::findOne(['id' => 999]))->empty();
    }
    
    public function testFindUserAttrById()
    {
        verify($user = UserAttr::findOne(['id' => 1]))->notEmpty();
        verify($user->email)->equals('m.ushakova@gazpromcps.ru');

        verify(UserAttr::findOne(['id' => 999]))->empty();
    }
    
    public function testFindUserStatusById()
    {
        verify($status = UserStatus::findOne(['id' => 1]))->notEmpty();
        verify($status->status)->equals('Забронирован');

        verify(UserStatus::findOne(['id' => 999]))->empty();
    }
    
}
