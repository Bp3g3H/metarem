<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChangePasswordForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Стара парола') ?>

    <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true])->label('Нова парола') ?>

    <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true])->label('Повтори нова парола') ?>


    <div class="form-group">
        <?= Html::submitButton('Смяна на паролата', ['class' =>'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
