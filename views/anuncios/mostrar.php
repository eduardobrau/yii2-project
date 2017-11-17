<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

?>

<div class="container">
  <div class="row">
    <div class="col-md-12">

      <?= GridView::widget([

        'dataProvider' => $dataProvider,

        'columns' => [
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
        ]

      ])?>

    </div>
  </div>
</div>