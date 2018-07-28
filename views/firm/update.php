<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Firm */

$this->title = 'Актуализация на фирма: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Фирми', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
?>
<div class="firm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
