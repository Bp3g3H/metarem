<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Firm */

$this->title = 'Добавяне на фирма';
$this->params['breadcrumbs'][] = ['label' => 'Фирми', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="firm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
