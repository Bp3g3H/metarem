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

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'firm_id') ?>

    <?= $form->field($model, 'product_name') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'material') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'price_for_cutting') ?>

    <?php // echo $form->field($model, 'full_weight') ?>

    <?php // echo $form->field($model, 'single_price_with_material') ?>

    <?php // echo $form->field($model, 'full_price') ?>

    <?php // echo $form->field($model, 'price_with_dds') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
