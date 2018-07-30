<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FirmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="firm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'name')->label('Име') ?>
        </div>
        <div class="col-sm-2">
            <?php  echo $form->field($model, 'country')->label('Държава') ?>
        </div>
        <div class="col-sm-2">
            <?php  echo $form->field($model, 'city')->label('Град') ?>
        </div>
         <div class="col-sm-2">
            <?php  echo $form->field($model, 'owner_name')->label('Собственик') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'email')->label('Емайл') ?>
        </div>
        <div class="col-sm-2">
            <div class="form-group" style="margin-top: 25px;">
                <?= Html::submitButton('Търсене', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Изчисти', \yii\helpers\Url::to(['/firm']), ['class' => 'btn btn-default'])?>
            </div>
        </div>
    </div>















    <?php ActiveForm::end(); ?>

</div>
