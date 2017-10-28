<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnunciosRedesSociaisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anuncios Redes Sociais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncios-redes-sociais-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Anuncios Redes Sociais', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'anuncio_id',
            'rede_social_id',
            'url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
