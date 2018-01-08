<?php

use yii\helpers\Html;
use app\components\helpers\StringToUrl;
use app\components\widgets\MapaWidget;
use yii\widgets\LinkPager;

//echo '<pre>'; print_r($pagination); echo '</pre>';

$this->title = 'Guia comercial de '.$anuncios[0]['bairro']['cidade']['cidade'];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="row">
  <div class="col-md-12">
    <?= MapaWidget::widget() ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Guia Comercial</h3>
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
      <div class="data-pagination">
        <?= LinkPager::widget([
          'pagination' => $pagination,
        ]);?>
      </div>

    </div>

  </div>

</div