<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Komis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="komis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nazwa')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lokalizacja')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'telefon')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'zdjecie_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
