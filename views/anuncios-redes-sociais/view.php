<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AnunciosRedesSociais */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anuncios Redes Sociais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncios-redes-sociais-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'anuncio_id' => $model->anuncio_id, 'rede_social_id' => $model->rede_social_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'anuncio_id' => $model->anuncio_id, 'rede_social_id' => $model->rede_social_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'anuncio_id',
            'rede_social_id',
            'url:url',
        ],
    ]) ?>

</div>
