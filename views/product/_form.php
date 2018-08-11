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

    <?= $form->field($model, 'services_checkbox')->checkboxList(\app\models\Product::getServices(), [
        'item' => function($index, $label, $name, $checked, $value) {
        $check = $checked ? 'checked' : '';
            return "<label><input type='checkbox' {$check} class='services-checkbox' name='{$name}' value='{$value}'> {$label}</label>";
        }
    ])->label('Услуги')?>

    <?= $form->field($model, 'quantity')->textInput()->label('Количество') ?>

    <?= $form->field($model, 'material_id')->dropDownList($materials)->label('Материал') ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true])->label('Тегло') ?>

    <?php
    $laserCuttingShow = isset($model->services[\app\models\Product::LASER_CUTTING_ABV]);
    ?>
    <div id="laser-cutting-field" style="<?= $laserCuttingShow ? ""  : 'display: none'?>">
        <?= $form->field($model, 'services[' . \app\models\Product::LASER_CUTTING_ABV . ']')->textInput($laserCuttingShow ? [] : ['disabled' => true])->label('Цена лазерно рязане') ?>
    </div>

    <?php
    $engravingShow = isset($model->services[\app\models\Product::ENGRAVING_ABV]);
    ?>
    <div id="engraving-field" style="<?= $engravingShow ? ""  : 'display: none'?>">
    <?= $form->field($model, 'services[' . \app\models\Product::ENGRAVING_ABV . ']')->textInput($engravingShow ? [] : ['disabled' => true])->label('Цена гравиране') ?>
    </div>

    <?php
    $punchingShow = isset($model->services[\app\models\Product::PUNCHING_ABV]);
    ?>
    <div id="punching-field" style="<?= $punchingShow ? ""  : 'display: none'?>">
    <?= $form->field($model, 'services[' . \app\models\Product::PUNCHING_ABV . ']')->textInput($punchingShow ? [] : ['disabled' => true])->label('Цена щанцоване') ?>
    </div>

    <?php
    $bendingShow = isset($model->services[\app\models\Product::BENDING_ABV]);
    ?>
    <div id="bending-field" style="<?= $bendingShow ? ""  : 'display: none'?>">
    <?= $form->field($model, 'services[' . \app\models\Product::BENDING_ABV . ']')->textInput($bendingShow ? [] : ['disabled' => true])->label('Цена огъване') ?>
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