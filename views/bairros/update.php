<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bairros */

$this->title = 'Update Bairros: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bairros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'cidade_id' => $model->cidade_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bairros-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
