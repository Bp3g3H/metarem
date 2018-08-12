<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-sm-2">
            <?php  echo $form->field($model, 'status')->dropDownList(\app\models\User::getStatusArr())->label('Статус') ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'username')->label('Потребителско име') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'name')->label('Име') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'email')->label('Емайл') ?>
        </div>
        <div class="col-sm-3">
            <div class="form-group" style="margin-top: 25px;">
                <?= Html::submitButton('Търсене', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Изчисти', \yii\helpers\Url::to(['/user']), ['class' => 'btn btn-default'])?>
            </div>
        </div>
    </div>













    <?php ActiveForm::end(); ?>

</div>
