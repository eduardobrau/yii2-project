<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnunciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anúncios';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="anuncios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Anuncios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' =>
        [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'titulo',
            'slogan',
            'texto:ntext',
            //StringHelper::truncate('texto:ntext', 20),
            'telefone',
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>
                [
                    'view' => function ($url, $model)
                    {
                        //echo '<pre>'; var_dump($model); echo '</pre>';
                        return Html::a('<button class="btn btn-xs glyphicon glyphicon-eye-open"></button>', "/anuncios/{$model->id}?bairro_id={$model->bairro_id}&categoria_id={$model->categoria_id}");
                    },
                    'update' => function ($url, $model)
                    {
                        return Html::a('<button class="btn btn-xs glyphicon glyphicon-pencil"></button>', "/anuncios/{$model->id}?bairro_id={$model->bairro_id}&categoria_id={$model->categoria_id}");
                    },
                    'delete' => function ($url, $model)
                    {
                        return Html::a('<button class="btn btn-xs glyphicon glyphicon-trash"></button>', "/anuncios/delete/{$model->id}?bairro_id={$model->bairro_id}&categoria_id={$model->categoria_id}");
                    }
                ]
            ],
        ],
    ]); ?>

</div>
