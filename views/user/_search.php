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
            <?php  echo $form->field($model, 'status')->dropDownList(\app\models\User::getStatusArr()) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'username') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-sm-2">
            <div class="form-group" style="margin-top: 25px;">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Reset', \yii\helpers\Url::to('/user/index'), ['class' => 'btn btn-default'])?>
            </div>
        </div>
    </div>













    <?php ActiveForm::end(); ?>

</div>
