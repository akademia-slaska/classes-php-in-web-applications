<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Zamowienia';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Stworz zamowienie', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'customer_id',
            'value' => function ($model) {
                return $model->customer ? $model->customer->first_name . ' ' . $model->customer->last_name : 'No customer';
            }
        ],
        'total_amount',
        'created_at',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
