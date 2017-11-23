<?php

namespace \app\classes\components\MyComponent;

class MyComponent extends Component{

  public $myString;

  public function printString(){
    print $this->$myString;
  }

}