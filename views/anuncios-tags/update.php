<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnunciosTags */

$this->title = 'Update Anuncios Tags: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anuncios Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'anuncio_id' => $model->anuncio_id, 'tag_id' => $model->tag_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anuncios-tags-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
