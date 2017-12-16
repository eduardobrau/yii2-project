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
            //'id',
            [
                'attribute' => 'id',
                'contentOptions'    => ['style' => 'width:50px;']
            ],
            //'titulo',
            [
                'attribute'  => 'titulo',
                'value'    => function($model){
                    return StringHelper::truncateWords($model->titulo, 12);
                }

            ],
            //'texto:ntext',
            'telefone',
            'endereco',
            'site',
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'contentOptions' => ['style' => 'width:100px;'],
                'buttons'=>
                [
                    'view' => function ($url, $model)
                    {
                        //echo '<pre>'; var_dump($model); echo '</pre>';
                        return Html::a('<button class="btn btn-xs btn-success glyphicon glyphicon-eye-open"></button>', "/anuncios/view?id={$model->id}&bairro_id={$model->bairro_id}&categoria_id={$model->categoria_id}");
                    },
                    'update' => function ($url, $model)
                    {
                        return Html::a('<button class="btn btn-xs btn-warning glyphicon glyphicon-pencil"></button>', "/anuncios/update?id={$model->id}&bairro_id={$model->bairro_id}&categoria_id={$model->categoria_id}");
                    },
                    'delete' => function ($url, $model)
                    {
                        return Html::a(
                            '<button class="btn btn-xs btn-danger glyphicon glyphicon-trash"></button>',
                             "/anuncios/delete?id={$model->id}&bairro_id={$model->bairro_id}&categoria_id={$model->categoria_id}",
                            [
                                'title'         => 'Excluir',
                                'data-pjax'     => '0',
                                'data-confirm'  => 'Confirma a exclusão deste item?',
                                'data-method'   => 'post',
                            ]
                        );
                    }
                ]
            ],
        ],
    ]); ?>

</div>
