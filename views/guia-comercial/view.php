<?php

use yii\helpers\Html;
use yii\bootstrap\Carousel;

//echo '<pre>'; print_r($anuncio); echo '</pre>';
//https://yii2-cookbook.readthedocs.io/adding-seo-tags/
$this->title = Html::encode($anuncio->titulo);
$this->registerMetaTag([
  'name' => 'description',
  'content' => Html::encode($anuncio->texto),
]);
$this->registerMetaTag([
  'name' => 'keywords',
  'content' => Html::encode("<script>alert('Isso é perigoso')</script>"),
]);

?>

<h1> <?= Html::encode($anuncio->titulo); ?> </h1>
<hr>
<div class="row">
  <div class="col-md-8">
    <?= 
    Carousel::widget([
      'items' => [
        // the item contains only the image
        [
          'content' => Html::img(Yii::getAlias('@web/img/slider/1.jpg'),['class'=>'img-responsive','style' => 'width:100%']),
          'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
          'options' => []
        ],
        [
          'content' => Html::img(Yii::getAlias('@web/img/slider/2.jpg'),['class'=>'img-responsive','style' => 'width:100%']),
          'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
          'options' => []
        ],
        [
          'content' => Html::img(Yii::getAlias('@web/img/slider/3.jpg'),['class'=>'img-responsive','style' => 'width:100%']),
          'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
          'options' => []
        ],
      ]
    ]);?>
  </div>

  <div class="col-md-4">
    <div class="card-view">
      <div class="text-card">
        <h3> "<?= Html::encode($anuncio->slogan); ?>" </h3>
        <p><?= Html::encode($anuncio->texto); ?></p>
      </div>
      <hr>
      <div class="address-card">
        <span class="rotule">Endereço</span>
        <address>
          <span><?= $anuncio->endereco ?></span><br>
          <span>Bairro:</span><span><?= $anuncio->bairro->bairro ?></span><br>
          <span>Cidade:</span><span><?= $anuncio->bairro->cidade->cidade ?></span><br>
          <span>Telefone:</span><span><?= $anuncio->telefone ?></span>
        </address>
      </div>
      <hr>
      <div class="social-midia">
        <span class="rotule">Midias Sociais</span>
        <ul>
          <?php 
            foreach ($anuncio->anunciosRedesSociais as $key => $value) {
              switch ($value->rede_social_id) {
                case '1':
                  if( !empty($value->url) ){
                    echo '<li><a href="'.$value->url.'"><span class="fa fa-facebook" aria-hidden="true"></span></a></li>';
                  }
                break;
                case '2':
                  if( !empty($value->url) ){
                    echo '<li><a href="'.$value->url.'"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>';
                  }
                break;
                case '3':
                  if( !empty($value->url) ){
                    echo '<li><a href="'.$value->url.'"><span class="fa fa-instagram" aria-hidden="true"></span></a></li>';
                  }
                break;
                case '4':
                  if( !empty($value->url) ){
                    echo '<li><a href="'.$value->url.'"><span class="fa fa-google-plus" aria-hidden="true"></span></a></li>';
                  }
                break;
                case '5':
                  if( !empty($value->url) ){
                    echo '<li><a href="'.$value->url.'"><span class="fa fa-linkedin" aria-hidden="true"></span></a></li>';
                  }
                break;
                default:
                  echo '<p>Não tem Redes Sociais</p>';
                break;
              }
            }
          ?>
        </ul>
      </div>
      <hr>
      <div class="tags-view">
        <span class="rotule">Tags Usada</span>
        <ul>
          <?php 
            foreach ($anuncio->anunciosTags as $key => $value) {
              echo $value->tag->tag;
            }
          ?>
        </ul>
      </div>
    </div><!--./card-view-->
  </div><!--./col-md-4-->

</div>