<?php

use yii\helpers\Html;
use app\components\helpers\StringToUrl;
use app\components\widgets\MapaWidget;
use yii\widgets\LinkPager;

//echo '<pre>'; print_r($pagination); echo '</pre>';

$this->title = (!empty($anuncios[0])) ? 'Guia comercial de ' .$anuncios[0]['bairro']['cidade']['cidade'] : '';
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="col-md-12 body-wrap">
  
  <?= MapaWidget::widget() ?>

  <div class="body-content">
    <div class="row">
      
      <div class="col-md-12">
        <?php if(!empty($anuncios[0])){ ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><h3 class="panel-title"><?= (!empty($anuncios[0])) ? 'Guia comercial de ' .$anuncios[0]['bairro']['cidade']['cidade'] : ''; ?></h3></h3>
            </div>
            <?php foreach ($anuncios as $anuncio) {?>
              <div class="panel-body">
                <div class="body-card">
                  <div class="resume-body" style="max-height:200px;" >
                    <figure class="thumbnail-card">
                      <img class="img-thumbnail" src="<?= Yii::getAlias('@web')?>/img/sem-imagem.jpeg">
                    </figure>
                  </div><!--./resume-body-->
                  <div class="description-body">
                    <div class="text-description">
                      <h4><?= Html::encode(yii\helpers\StringHelper::truncate($anuncio['titulo'],60,'...')) ?></h4>
                      <?= Html::encode(yii\helpers\StringHelper::truncate($anuncio['texto'],160,'...')) ?>
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
                      <?= Html::a($anuncio['bairro']['cidade']['cidade'], [ '/anuncios/pesquisar?cidade_id='.$anuncio['bairro']['cidade']['id'] ], ['class' => 'city-location'])?>
                      <?= Html::a("{$anuncio['bairro']['bairro']}", [ '/anuncios/pesquisar?bairro_id='.$anuncio['bairro']['id'] ], ['class' => 'neighborhood-location'])?>
                      <span class="street"><?= Html::encode(yii\helpers\StringHelper::truncate($anuncio['endereco'],80,'...')) ?></span>
                    </address>
                    <hr>
                    <?= Html::a('Detalhes', [StringToUrl::convertOnUrl("guia-comercial/{$anuncio['bairro']['cidade']['cidade']}/{$anuncio['titulo']}/{$anuncio['id']}"), 'id' => $anuncio['id']], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('Telefone', [StringToUrl::convertOnUrl("guia-comercial/{$anuncio['bairro']['cidade']['cidade']}/{$anuncio['titulo']}/{$anuncio['id']}"), 'id' => $anuncio['id'], ['anuncio' => $anuncio['titulo'],'id' => $anuncio['id']]], ['class' => 'btn btn-default']) ?>
                  </div><!--./description-body-->
                </div><!--./body-card-->
              </div><!--./panel-body-->
              <hr style="margin:20px 10px 20px">
            <?php }?>
            
            <div class="data-pagination">
              <?= LinkPager::widget([
                'pagination' => $pages,
              ]);?>
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
      </div><!--/.col-md-12-->

    </div><!--/.row-->
  </div><!--/.body-content-->
    
</div><!--/.body-wrap-->