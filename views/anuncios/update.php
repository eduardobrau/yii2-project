<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anuncios */

$this->title = 'Update Anuncios: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anuncios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'bairro_id' => $model->bairro_id, 'categoria_id' => $model->categoria_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anuncios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
