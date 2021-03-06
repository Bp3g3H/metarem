<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'created_at')->label('Дата') ?>
        </div>
        <div class="col-md-2 ">
            <?= $form->field($model, 'firm_id')->dropDownList(\app\models\Firm::getFirmsForDropdown())->label('Фирма') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'product_name')->label('Детайл') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'material_id')->dropDownList(\app\models\Material::getMaterialsForDropdown())->label('Материал') ?>
        </div>
        <div class="col-md-3">
            <div class="form-group" style="margin-top: 25px;">
                <?= Html::submitButton('Търсене', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Изчисти', \yii\helpers\Url::to(['/product']), ['class' => 'btn btn-default'])?>
            </div>
        </div>
    </div>











    <?php ActiveForm::end(); ?>

</div>
