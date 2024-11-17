<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Order: ' . $model->id;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->dropDownList($customers) ?>

    <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
