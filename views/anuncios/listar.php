<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnunciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anúncios';
$this->params['breadcrumbs'][] = $this->title;
//echo '<pre>'; print_r($anuncios); echo '</pre>';
?>

<div class="anuncios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Anuncios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

  <table class="table table-bordered">

    <tbody>
      <?php
      for($i=0; $i < count($anuncios); $i++){ ?>
        <tr>
          <td>ID:</td>
          <td><?= $anuncios[$i]['id'] ?></td>
        </tr>
        <tr>
          <td>Titulo:</td>
          <td><?= $anuncios[$i]['titulo'] ?></td>
        </tr>
        <tr>
          <td>Slogan:</td>
          <td><?= $anuncios[$i]['slogan'] ?></td>
        </tr>
        <tr>
          <td>Texto:</td>
          <td><?= $anuncios[$i]['texto'] ?></td>
        </tr>
        <tr>
          <td>Telefone:</td>
          <td><?= $anuncios[$i]['telefone'] ?></td>
        </tr>
        <tr>
          <td>Site:</td>
          <td><?= $anuncios[$i]['site'] ?></td>
        </tr>
        <tr>
          <td>Endereço:</td>
          <td><?= $anuncios[$i]['endereco'] ?></td>
        </tr>
        <tr>
          <td>Bairro:</td>
          <td><?= $anuncios[$i]['bairro_id'] ?></td>
        </tr>
        <tr>
          <td>Categoria:</td>
          <td><?= $anuncios[$i]['categoria_id'] ?></td>
        </tr>
        <tr>
          <td>Redes Sociais:</td>
          <td>
            <?php
            foreach($anuncios[$i]['anunciosRedesSociais'] as $key => $rede){
              foreach ($rede as $key => $value) {
                switch ($key) {
                  case 'url':
                    ($value !== '') ? $sociais[] = $value : '';
                  break;
                }
              }

            }

            echo $redesSoc = implode(", " ,$sociais);

            ?>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>

  <?= LinkPager::widget([
    'pagination' => $pagination,
  ]);?>

</div>