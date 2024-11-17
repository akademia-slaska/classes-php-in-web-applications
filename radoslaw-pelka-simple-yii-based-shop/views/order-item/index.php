<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Order Items';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Create Order Item', ['order-item/create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'order_id',
            'value' => function ($model) {
                return 'Order #' . $model->order_id;
            }
        ],
        [
            'attribute' => 'product_id',
            'value' => function ($model) {
                return $model->product ? $model->product->name : 'No product';
            }
        ],
        'quantity',
        'price',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
