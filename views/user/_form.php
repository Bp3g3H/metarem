<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('Потребителско име') ?>

    <?php
    if($model->isNewRecord)
        $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Парола')
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Име') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Емайл') ?>

    <?php  echo $form->field($model, 'status')->dropDownList(\app\models\User::getStatusArr())->label('Статус') ?>

    <?php  echo $form->field($model, 'role')->dropDownList(\app\models\User::getRoleArr())->label('Роля') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Създаване' : 'Актуализиране', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
