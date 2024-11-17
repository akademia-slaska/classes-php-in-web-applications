<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Zamowienie #' . $model->id;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Czy napewno chcesz usunac ten wpis?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        [
            'attribute' => 'customer_id',
            'value' => $model->customer ? $model->customer->first_name . ' ' . $model->customer->last_name : 'No customer',
        ],
        'total_amount',
        'created_at',
    ],
]) ?>
