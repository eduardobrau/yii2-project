<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BairrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bairros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bairros-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bairros', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bairro',
            'cep',
            //'cidade_id',
            [
                'attribute' => 'cidade_id',
                'label' => 'Cidade',
                'value' => function($model){
                    return $model->cidade->cidade;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
