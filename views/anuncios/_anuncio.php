<?php

use yii\helpers\Html;
use app\components\helpers\StringToUrl;
?>

<div class="panel-body">
  <div class="body-card">
    <div class="resume-body" style="max-height:200px;" >
      <figure class="thumbnail-card">
        <img class="img-thumbnail" src="<?= Yii::getAlias('@web')?>/img/sem-imagem.jpeg">
      </figure>
    </div><!--./resume-body-->
    <div class="description-body">
      <div class="text-description">
        <h4><?= Html::encode(yii\helpers\StringHelper::truncate($model['titulo'],60,'...')) ?></h4>
        <?= Html::encode(yii\helpers\StringHelper::truncate($model['texto'],160,'...')) ?>
      </div>
      <hr>
      <div class="social-midia">
        <h4>Compartilhe</h4>
        <ul>
          <li>
            <a href="#" class="facebook">
            <span class="fa fa-facebook" aria-hidden="true"></span>
            </a>
          </li>
          <li>
            <a href="#" class="twitter">
            <span class="fa fa-twitter" aria-hidden="true"></span>
            </a>
          </li>
          <li>
            <a href="#" class="instagram">
            <span class="fa fa-instagram" aria-hidden="true"></span>
            </a>
          </li>
          <li>
            <a href="#" class="instagram">
            <span class="fa fa-google-plus" aria-hidden="true"></span>
            </a>
          </li>
          <li>
            <a href="#" class="instagram">
            <span class="fa fa-linkedin" aria-hidden="true"></span>
            </a>
          </li>
        </ul>
      </div>
      <hr>
      <address>
        <?= Html::a($model['bairro']['cidade']['cidade'], [ '/anuncios/pesquisar?cidade_id='.$model['bairro']['cidade']['id'] ], ['class' => 'city-location'])?>
        <?= Html::a("{$model['bairro']['bairro']}", [ '/anuncios/pesquisar?bairro_id='.$model['bairro']['id'] ], ['class' => 'neighborhood-location'])?>
        <span class="street"><?= Html::encode(yii\helpers\StringHelper::truncate($model['endereco'],80,'...')) ?></span>
      </address>
      <hr>
      <?= Html::a('Detalhes', [StringToUrl::convertOnUrl("guia-comercial/{$model['bairro']['cidade']['cidade']}/{$model['titulo']}/{$model['id']}"), 'id' => $model['id']], ['class' => 'btn btn-default']) ?>
      <?= Html::a('Telefone', [StringToUrl::convertOnUrl("guia-comercial/{$model['bairro']['cidade']['cidade']}/{$model['titulo']}/{$model['id']}"), 'id' => $model['id'], ['anuncio' => $model['titulo'],'id' => $model['id']]], ['class' => 'btn btn-default']) ?>
    </div><!--./description-body-->
  </div><!--./body-card-->
</div><!--./panel-body-->
<hr style="margin:20px 10px 20px">