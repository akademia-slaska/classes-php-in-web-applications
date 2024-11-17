<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItem */
/* @var $form yii\widgets\ActiveForm */
/* @var $productList array */
/* @var $orderList array */

?>

<div class="order-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->dropDownList(
        $orderList,
        ['prompt' => 'Select an order']
    ) ?>

    <?= $form->field($model, 'product_id')->dropDownList(
        $productList,
        ['prompt' => 'Select a product', 'id' => 'product-dropdown']
    ) ?>

    <?= $form->field($model, 'quantity')->textInput(['id' => 'quantity-input']) ?>

    <?= $form->field($model, 'price')->textInput(['readonly' => true, 'id' => 'price-input']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$ajaxUrl = Url::to(['order-item/get-product-price']);
$js = <<<JS
    function updatePrice() {
        var productId = $('#product-dropdown').val();
        var quantity = $('#quantity-input').val();

        if (productId) {
            $.ajax({
                url: '$ajaxUrl',
                type: 'GET',
                data: { id: productId },
                success: function(response) {
                    var data = JSON.parse(response);
                    var price = data.price;
                    $('#price-input').val((price * quantity).toFixed(2));
                }
            });
        }
    }
    
    $('#product-dropdown').change(updatePrice);
    $('#quantity-input').on('input', updatePrice);
JS;
$this->registerJs($js);
?>
