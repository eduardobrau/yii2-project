<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RedesSociaisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Redes Sociais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redes-sociais-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Redes Sociais', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'rede_social',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
