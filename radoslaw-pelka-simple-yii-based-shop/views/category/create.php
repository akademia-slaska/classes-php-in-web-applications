<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Stwórz kategorie';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
