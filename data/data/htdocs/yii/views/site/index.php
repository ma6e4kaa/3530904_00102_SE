<?php
use yii\helpers\Html;
use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\Marker;
use dosamigos\leaflet\layers\TileLayer;
use dosamigos\leaflet\LeafLet;
use dosamigos\leaflet\widgets\Map;
/** @var yii\web\View $this */

$this->title = 'FunTravel';
?>
<style>
    .content {
        background-color: #fff;
        border-radius: 20px;
        padding: 20px; 
        box-shadow: rgba(0, 0, 0, 0.3) 0 1px 3px;
    }
    .content:hover {
        background-color: #fff;
        border-radius: 20px;
        padding: 20px; 
        box-shadow: rgba(0, 0, 0, 0.3) 0 2px 5px;
    }
    td {
        vertical-align: top;
    }
</style>
<div class="content">
<div class="site-index">
    <center><h2><?= Html::encode('Туристическое агенство FunTravel') ?></h2></center>
    <table>
        <!--<tr><td><?/= Html::encode('') ?></td><td></td></tr>-->
        <tr><td><?= Html::encode('Наше турагентство FunTravel является лидером туристического рынка уже в течение 15 лет.В 2014 году FunTravel получает награду в области регионального развития в туристической области "The Best Young Tour Company".') ?></td><td><img src="https://sun9-30.userapi.com/impf/c628417/v628417374/ac1f/fZUbIoT0Ttw.jpg?size=604x414&quality=96&sign=97b04d68d088576e59a5154aeab2f0f5&type=album" alt="The Best Young Tour Company 2014"/></td></tr>
        <tr><td><?= Html::encode('В 2015 году FunTravel получает 5 звёзд от Международной туристической организации в России по 1300 независимым отзывам от клиентов туристических агентств.') ?></td><td><img src="http://nagrada33.ru/image/cache/data/kubki/rossiya-228x228.jpg" alt="5 stars 2015"/></td></tr>
        <tr><td><?= Html::encode('В 2016 году компания насчитывает уже свыше 130 сотрудников в штате, 35 из которых были удостоены звания "Лучший экскурсовод сезона".') ?></td><td><img src="https://tse4.mm.bing.net/th?id=OIP.CB8oLfOBdt1sffdFs17ejwHaDz&pid=Api" alt="Лучший экскурсовод 2016"/></td></tr>
    </table>
    <h3><?= Html::encode('Компания FunTravel готова предложить следующие услуги:')?></h3>
    <ul>
        <li><?= Html::encode('Заказ тура более чем по 50 городам России;')?></li>
        <li><?= Html::encode('Индивидуальные маршруты, которые выбираются под Ваши личные предпочтения;')?></li>
        <li><?= Html::encode('Вежливые и компетентные экскурсоводы со стажем от 5 лет на туристическом рынке;')?></li>
        <li><?= Html::encode('Возможность оформления сувенирной продукции по выгодным скидочным тарифам при покупке нескольких туров в нашей компании;')?></li>
        <li><?= Html::encode('Комфортные и безопасные автобусы с медиа центром и оборудованной системой навигации;')?></li>
        <li><?= Html::encode('Трансфер до места жительства и от него при заказе тура.')?></li>
    </ul>
    <?= Html::encode('При заказе туров в FunTravel Вы получаете не только приятные впечатления, воспоминания на всю жизнь, но и дополнительные скидки на товары партнёров, с которыми мы сотрудничаем!')?>

</div>
</div>
