<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $firms array */
/* @var $materials array */

$this->title = 'Актуализация на продукт: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'firms' => $firms,
        'materials' => $materials
    ]) ?>

</div>
