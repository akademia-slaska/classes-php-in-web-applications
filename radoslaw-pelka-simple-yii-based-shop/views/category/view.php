<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Edytuj', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Usun', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Czy na pewno chcesz usunąc ten wpis??',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'description:ntext',
    ],
]) ?>
