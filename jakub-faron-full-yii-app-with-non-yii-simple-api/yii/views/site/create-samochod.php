<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Samochod */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Dodaj Samochód';
$this->params['breadcrumbs'][] = ['label' => 'Komisy', 'url' => ['komisy']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="samochod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'marka')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'rok')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'zdjecie_url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'komis_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
