<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Stworz zamowienie';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($customers, 'id', function($model) {
            return $model->first_name . ' ' . $model->last_name;
        }),
        ['prompt' => 'Wybierz klienta']
    ) ?>

    <?= $form->field($model, 'total_amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
