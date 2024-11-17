<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Produkty';
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Stwórz produkt', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'description',
        'price',
        [
            'attribute' => 'category_id',
            'value' => function ($model) {
                return $model->category ? $model->category->name : 'No category';
            }
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php
