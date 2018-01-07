<?php

namespace app\components\widgets;

// Importa a classe pai que contém a estrutura de um widget
use yii\base\Widget;
use yii\helpers\Html;

class HelloWidget extends Widget
{
  public $message;

  public function init()
  {
    parent::init();

    if ($this->message === null) {
      $this->message = 'Hello World';
    }

  }

  public function run()
  {
    return Html::encode($this->message);
  }

}