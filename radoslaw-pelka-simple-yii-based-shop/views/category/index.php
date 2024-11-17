<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Kategorie';
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Stwórz kategorie', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'description',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
