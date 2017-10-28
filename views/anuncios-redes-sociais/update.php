<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnunciosRedesSociais */

$this->title = 'Update Anuncios Redes Sociais: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anuncios Redes Sociais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'anuncio_id' => $model->anuncio_id, 'rede_social_id' => $model->rede_social_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anuncios-redes-sociais-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
