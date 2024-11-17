
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Komis */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Edytuj dane komisu: ' . $model->nazwa;
$this->params['breadcrumbs'][] = ['label' => 'Komisy', 'url' => ['komisy']];
$this->params['breadcrumbs'][] = ['label' => $model->nazwa, 'url' => ['view-komis', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edytuj';
?>

<div class="komis-update">

    <h1><?= Html::encode($this->title) ?></h1>

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
