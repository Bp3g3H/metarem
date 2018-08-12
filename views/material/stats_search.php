<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StatsForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-search">

    <?php $form = ActiveForm::begin([
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'name')->label('Материал') ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'search_from')->textInput(['class'=>'datepicker form-control'])->label('От') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'search_to')->textInput(['class'=>'datepicker form-control'])->label('До') ?>
        </div>
        <div class="col-sm-3">
            <div class="form-group" style="margin-top: 25px;">
                <?= Html::submitButton('Търсене', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Изчисти', \yii\helpers\Url::to(['material/stats']), ['class' => 'btn btn-default'])?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$script = <<<JS
    $('.datepicker').datetimepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        minView: 2
    });
JS;

$this->registerJs($script, \yii\web\View::POS_END);
?>