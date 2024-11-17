<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $komisy app\models\Komis[] */

$this->title = 'Lista Komisów';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .site-komisy ul {
        list-style-type: none;
        padding: 0;
    }
    .komis-container {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        padding: 10px;
    }
    .komis-info {
        margin-bottom: 10px;
        font-weight: bold;
    }
    .komis-content {
        display: flex;
        align-items: flex-start;
        margin-bottom: 10px;
    }
    .komis-image {
        margin-right: 20px;
    }
    .komis-image img {
        width: 250px; /* Zwiększona szerokość zdjęć komisów */
        height: auto;
    }
    .komis-cars {
        flex-grow: 1;
    }
    .car-list {
        display: flex;
        justify-content: center; /* Wycentrowanie listy samochodów */
        padding: 0;
        margin: 0;
        list-style: none;
        flex-wrap: wrap; /* Dodaj flex-wrap, aby samochody mogły zawijać się do nowego wiersza */
    }
    .car-container {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
        width: 150px; /* Ustaw szerokość na tyle, aby elementy były w jednym rzędzie */
        box-sizing: border-box;
    }
    .car-image img {
        width: 100%;
        height: auto;
    }
    .komis-actions {
        margin-top: 10px;
    }
</style>





<div class="site-komisy">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Dodaj komis', ['site/create-komis'], ['class' => 'btn btn-success']) ?>
    </p>
    <ul>
        <?php foreach ($komisy as $komis): ?>
        <li class="komis-container">
            <div class="komis-info">
                <?= Html::a(Html::encode($komis->nazwa), ['site/view-komis', 'id' => $komis->id]) ?> - <?= Html::encode($komis->lokalizacja) ?> - <?= Html::encode($komis->telefon) ?>
            </div>
            <div class="komis-content">
                <?php if ($komis->zdjecie_url): ?>
                <div class="komis-image">
                    <?= Html::a(Html::img($komis->zdjecie_url, ['alt' => 'Zdjęcie komisu', 'style' => 'width:250px; height:auto;']), ['site/view-komis', 'id' => $komis->id]) ?>
                </div>
                <?php endif; ?>
                <div class="komis-cars">
                    <h4>Dostępne samochody:</h4>
                    <ul class="car-list">
                        <?php foreach ($komis->samochody as $samochod): ?>
                        <li class="car-container">
                            <?= Html::encode($samochod->marka) ?> <?= Html::encode($samochod->model) ?>
                            <?php if ($samochod->zdjecie_url): ?>
                            <div class="car-image">
                                <img src="<?= Html::encode($samochod->zdjecie_url) ?>" alt="Zdjęcie samochodu">
                            </div>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="komis-actions">
                <?= Html::a('Usuń', ['site/delete-komis', 'id' => $komis->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Czy na pewno chcesz usunąć ten komis?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Dodaj samochod', ['site/create-samochod', 'komis_id' => $komis->id], ['class' => 'btn btn-primary']) ?>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>


