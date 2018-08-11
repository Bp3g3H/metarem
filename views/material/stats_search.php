<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StatsForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'name')->label('Продукт') ?>
        </div>
<!--        <div class='col-md-2    '>-->
<!--            <div class="form-group">-->
<!--                <div class='input-group date' id='datetimepicker-from'>-->
<!--                    <input type='text' class="form-control" name="StatsForm[search_from]"/>-->
<!--                    <span class="input-group-addon">-->
<!--                    <span class="glyphicon glyphicon-calendar"></span>-->
<!--                </span>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class='col-md-2'>-->
<!--            <div class="form-group">-->
<!--                <div class='input-group date' id='datetimepicker-to'>-->
<!--                    <input type='text' class="form-control" name="StatsForm[search_to]"/>-->
<!--                    <span class="input-group-addon">-->
<!--                    <span class="glyphicon glyphicon-calendar"></span>-->
<!--                </span>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="col-sm-2">
            <?= $form->field($model, 'search_from')->label('От') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'search_to')->label('До') ?>
        </div>
        <div class="col-sm-2">
            <div class="form-group" style="margin-top: 25px;">
                <?= Html::submitButton('Търсене', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Изчисти', \yii\helpers\Url::to(['/material']), ['class' => 'btn btn-default'])?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$script = <<<JS
    $(function () {
        $('#datetimepicker-from').datetimepicker();
        $('#datetimepicker-to').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker-from").on("dp.change", function (e) {
            $('#datetimepicker-to').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker-to").on("dp.change", function (e) {
            $('#datetimepicker-from').data("DateTimePicker").maxDate(e.date);
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_END);
?>