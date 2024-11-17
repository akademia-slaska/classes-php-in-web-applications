<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->first_name . ' ' . $model->last_name;
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
        'first_name',
        'last_name',
        'email:email',
        'address:ntext',
        'phone',
    ],
]) ?>
