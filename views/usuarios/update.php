<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DBUsuarios */

$this->title = 'Update Dbusuarios: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dbusuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dbusuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
