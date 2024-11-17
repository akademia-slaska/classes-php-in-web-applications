<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Klienci';
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Stwórz klienta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'first_name',
        'last_name',
        'email',
        'address',
        'phone',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php
