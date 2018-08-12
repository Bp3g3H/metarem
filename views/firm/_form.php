<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Firm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="firm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Име') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Емайл') ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('Адрес') ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true])->label('Тел. номер') ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true])->label('Град') ?>

    <?= $form->field($model, 'owner_name')->textInput(['maxlength' => true])->label('Собственик') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавяне' : 'Актуализиране', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
