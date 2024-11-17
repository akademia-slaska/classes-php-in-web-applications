<?php
use yii\helpers\Html;

$this->title = 'Menu główne';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="menu">
    <p><?= Html::a('Produkty', ['/product/index'], ['class' => 'btn btn-primary']) ?></p>
    <p><?= Html::a('Kategorie', ['/category/index'], ['class' => 'btn btn-primary']) ?></p>
    <p><?= Html::a('Klienci', ['/customer/index'], ['class' => 'btn btn-primary']) ?></p>
    <p><?= Html::a('Zamówienia', ['/orders/index'], ['class' => 'btn btn-primary']) ?></p>
    <p><?= Html::a('Zamówione produkty', ['/order-item/index'], ['class' => 'btn btn-primary']) ?></p>
</div>
