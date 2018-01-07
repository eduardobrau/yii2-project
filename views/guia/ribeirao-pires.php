<?php

use yii\helpers\Html;
use app\components\helpers\StringToUrl;
use app\components\widgets\MapaWidget;

//echo '<pre>'; print_r($anuncios); echo '</pre>'; die;

$this->title = 'Guia de '.$anuncios[0]['bairro']['cidade']['cidade'];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="row">
  <div class="col-md-12">
    <?= MapaWidget::widget() ?>
  </div>
  <div class="col-md-8">
    <?php if(!empty($anuncios[0])){ ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Empresas</h3>
        </div>
        <?php foreach ($anuncios as $anuncio) {?>
          <div class="panel-body">
            <div class="body-card">
              <figure style="max-width:360px; max-height:200px;" class="thumbnail-card">
                <img class="img-thumbnail" src="<?= Yii::getAlias('@web')?>/img/sem-imagem.jpeg">
              </figure>
              <div class="text-description">
                <?= Html::encode(yii\helpers\StringHelper::truncate($anuncio['titulo'],60,'...')) ?>
                <?= Html::encode(yii\helpers\StringHelper::truncate($anuncio['texto'],160,'...')) ?>
              </div>
              <hr>
              <p>
                <?= Html::a($anuncio['bairro']['cidade']['cidade'], [ Yii::$app->controller->action->id ], ['class' => 'city-local'])?>
                <?= Html::a("{$anuncio['bairro']['bairro']}", StringToUrl::convertOnUrl([ $anuncio['bairro']['bairro'] ]), ['class' => 'city-local'])?>
              </p>
              <hr>
              <?= Html::a('Detalhes', [StringToUrl::convertOnUrl("guia-comercial/{$anuncio['bairro']['cidade']['cidade']}/{$anuncio['titulo']}/{$anuncio['id']}")], ['class' => 'btn btn-default']) ?>
              <?= Html::a('Telefone', ['santo-andre/view', ['anuncio' => $anuncio['titulo'],'id' => $anuncio['id']]], ['class' => 'btn btn-default']) ?>
            </div>
          </div>
        <?php }?>

        <div class="btn-view-all">
          <?= Html::a('Ver todos', [StringToUrl::convertOnUrl("guia-comercial/{$anuncio['bairro']['cidade']['cidade']}")], ['class' => 'btn btn-primary']) ?>
        </div>

      </div>
    <?php
    }else{
      echo '
      <div class="alert alert-danger">
        <strong>Atenção!</strong> Ainda não há dados cadastrados.
      </div>';
    }
    ?>
  </div>

  <div class="col-md-4">
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Previsão do Tempo</h3>
      </div>
      <div class="panel-body"> 
        <div class="widget-tempo"
          <!-- Widget Previs&atilde;o de Tempo CPTEC/INPE --><iframe allowtransparency="true" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="http://www.cptec.inpe.br/widget/widget.php?p=4354&w=h&c=909090&f=ffffff" height="200px" width="215px"></iframe><noscript>Previs&atilde;o de <a href="http://www.cptec.inpe.br/cidades/tempo/4354">Ribeirão Pires/SP</a> oferecido por <a href="http://www.cptec.inpe.br">CPTEC/INPE</a></noscript><!-- Widget Previs&atilde;o de Tempo CPTEC/INPE -->
        </div>
      </div>
    </div>  

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