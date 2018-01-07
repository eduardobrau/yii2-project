<?php

namespace app\components\widgets;

// Importa a classe pai que contém a estrutura de um widget
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Cidades;
use app\models\Tags;
use app\models\Categorias;

class MapaWidget extends Widget
{
  public $tags;
  public $categorias;
  public $cidades;

  public function init()
  {
    parent::init();

    $this->cidades = Cidades::find()->all();
    $this->tags = Tags::find()->all();
    $this->categorias = Categorias::find()->all();

  }

  public function run()
  {
    return $this->render('form-map',[
      'tags' => $this->tags,
      'categorias' => $this->categorias,
      'cidades' => $this->cidades,
    ]);
  }

}