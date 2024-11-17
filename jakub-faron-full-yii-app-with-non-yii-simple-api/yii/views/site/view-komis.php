<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $komis app\models\Komis */

$this->title = $komis->nazwa;
$this->params['breadcrumbs'][] = ['label' => 'Komisy', 'url' => ['komisy']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .komis-view .komis-image {
        margin-bottom: 20px;
    }
    .komis-img {
        width: 300px; /* Szerokość zdjęcia komisu */
        height: auto;
    }
    .komis-cars {
        flex-grow: 1;
    }
    .car-list {
        display: flex;
        flex-wrap: wrap; /* Flexbox z zawijaniem wierszy */
        padding: 0;
        margin: 0;
        list-style: none;
        justify-content: center; /* Wyśrodkowanie listy samochodów */
    }
    .car-container {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
        width: 200px; /* Stała szerokość dla samochodów */
        box-sizing: border-box;
        text-align: center; /* Wyśrodkowanie tekstu */
    }
    .car-image {
        margin-top: 10px;
    }
    .car-img {
        width: 180px; /* Stała szerokość dla obrazków samochodów */
        height: 120px; /* Stała wysokość dla obrazków samochodów */
        object-fit: cover; /* Upewnij się, że obrazki zachowują proporcje */
    }
</style>


<div class="komis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edytuj dane komisu', ['site/update-komis', 'id' => $komis->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Dodaj samochód', ['site/create-samochod', 'komis_id' => $komis->id], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="komis-info">
        <p><strong>Lokalizacja:</strong> <?= Html::encode($komis->lokalizacja) ?></p>
        <p><strong>Telefon:</strong> <?= Html::encode($komis->telefon) ?></p>
        <?php if ($komis->zdjecie_url): ?>
        <div class="komis-image">
            <img src="<?= Html::encode($komis->zdjecie_url) ?>" alt="Zdjęcie komisu" class="komis-img">
        </div>
        <?php endif; ?>
    </div>

    <div class="komis-cars">
        <h4>Samochody w komisie:</h4>
        <ul class="car-list">
            <?php foreach ($komis->samochodies as $samochod): ?>
            <li class="car-container">
                <?= Html::encode($samochod->marka) ?> <?= Html::encode($samochod->model) ?>
                <?php if ($samochod->zdjecie_url): ?>
                <div class="car-image">
                    <img src="<?= Html::encode($samochod->zdjecie_url) ?>" alt="Zdjęcie samochodu" class="car-img">
                </div>
                <?php endif; ?>
                <div class="car-actions">
                    <?= Html::a('Usuń', ['site/delete-samochod', 'id' => $samochod->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => 'Czy na pewno chcesz usunąć ten samochód?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

