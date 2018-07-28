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

    <?= $form->field($model, 'quantity')->textInput()->label('Количество') ?>

    <?= $form->field($model, 'material_id')->dropDownList($materials)->label('Материал') ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true])->label('Цена') ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true])->label('Тегло') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Създаване' : 'Актуализиране', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
