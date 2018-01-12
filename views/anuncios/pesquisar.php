<?php

use yii\helpers\Html;
use app\components\widgets\MapaWidget;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

//echo '<pre>'; print_r($anuncios); echo '</pre>';

$this->title = 'Resultado de Busca';
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="row">
  
  <div class="col-md-12">
    <?= MapaWidget::widget() ?>
  </div>
  
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><h3 class="panel-title">Resultado da Pesquisa</h3></h3>
      </div>
      
      <?= ListView::widget([
        'dataProvider' => $anuncios,
        'itemView' => '_anuncio',
        ]);
      ?>

    </div>
  </div>
  
  <div class="col-md-4">
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Noticias</h3>
      </div>
      <div class="panel-body">
      <ul class="media-list">
        <li class="media">
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" src="..." alt="...">
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading">A indústria diademense</h4>
              <?php $noticias[0] = "
              <p>
                Diadema possuía, em 1964, apenas oito indústrias em 
                funcionamento regular; nove anos depois, em 1973, o seu
                parque industrial reunia 305, com outras 201 em processo
                de instalação.
              </p>"; ?>
              <?= Html::encode(yii\helpers\StringHelper::truncate($noticias[0],160,'...')) ?>
            </div>
          </div> 
        </li>
      </ul>  
      </div>
    </div>

    
  </div>

</div