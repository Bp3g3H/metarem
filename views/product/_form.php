<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $firms array */
/* @var $materials array */

?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firm_id')->dropDownList($firms)->label('Фирма') ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true])->label('Име на продукта') ?>

    <?= $form->field($model, 'services')->checkboxList(\app\models\Product::getServices(), [
        'item' => function($index, $label, $name, $checked, $value) {
            return "<label><input type='checkbox' {$checked} class='services-checkbox' name='{$name}' value='{$value}'> {$label}</label>";
        }
    ])->label('Услуги')?>

    <?= $form->field($model, 'quantity')->textInput()->label('Количество') ?>

    <?= $form->field($model, 'material_id')->dropDownList($materials)->label('Материал') ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true])->label('Цена') ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true])->label('Тегло') ?>

    <div id="laser-cutting-field" style="display: none">
        <?= $form->field($model, 'services[' . \app\models\Product::LASER_CUTTING . ']')->textInput(['disabled' => true])->label('Цена лазерно рязане') ?>
    </div>
    <div id="engraving-field" style="display: none">
    <?= $form->field($model, 'quantity[' . \app\models\Product::ENGRAVING . ']')->textInput(['disabled' => true])->label('Цена гравиране') ?>
    </div>
    <div id="punching-field" style="display: none">
    <?= $form->field($model, 'quantity[' . \app\models\Product::PUNCHING . ']')->textInput(['disabled' => true])->label('Цена щанцоване') ?>
    </div>
    <div id="bending-field" style="display: none">
    <?= $form->field($model, 'quantity[' . \app\models\Product::BENDING . ']')->textInput(['disabled' => true])->label('Цена огъване') ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Създаване' : 'Актуализиране', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<<JS
    $(function(){
        $('.services-checkbox').on('change', function() {
            var element = null;
            switch ($(this).val()){
                case "0":
                    element = $('#laser-cutting-field');
                    break;
                case "1":
                    element = $('#engraving-field');
                    break;
                case "2":
                    element = $('#punching-field');
                    break;
                case "3":
                    element = $('#bending-field');
                    break;
            }
            
            if(element.is(":hidden"))
            {
                element.find('input').prop('disabled', false);
                element.show();
            }
            else
            {
                element.find('input').prop('disabled', true);
                element.hide();
            }
        })
    })  
JS;

$this->registerJs($script, \yii\web\View::POS_END)
?>