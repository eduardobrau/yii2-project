<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnunciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anuncios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Anuncios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'slogan',
            'texto:ntext',
            'telefone',
            // 'endereco',
            // 'site',
            // 'bairro_id',
            // 'categoria_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
