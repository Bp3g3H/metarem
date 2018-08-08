<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'firm_name')->dropDownList(\app\models\Firm::getFirmsForDropdown())->label('Фирма') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'status')->dropDownList(\app\models\Order::getStatusArray())->label('Статус') ?>
        </div>
        <div class="col-sm-2">
            <div class="form-group" style="margin-top: 25px;">
                <?= Html::submitButton('Търсене', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Изчисти', \yii\helpers\Url::to(['/order']), ['class' => 'btn btn-default'])?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
