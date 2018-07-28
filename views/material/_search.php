<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'name')->label('Материал') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'price')->label('Цена') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'created_at')->label('Дата') ?>
        </div>
        <div class="col-sm-2">
            <div class="form-group" style="margin-top: 25px;">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Reset', \yii\helpers\Url::to('material/index'), ['class' => 'btn btn-default'])?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
