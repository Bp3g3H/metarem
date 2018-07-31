<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Име') ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true])->label('Цена') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавяне' : 'Актуализиране', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
