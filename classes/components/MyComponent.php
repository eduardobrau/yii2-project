<?php

namespace app\classes\components;

use Yii;
use yii\base\Component;

class MyComponent extends Component{

  public $myString;

  public function printString($nome){
    $this->myString = $nome;
    print $this->myString;
  }

}