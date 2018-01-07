<?php

namespace app\components\helpers;

use Yii;
use yii\base\Component;

class StringToUrl extends Component{

  public static $data;
  
  private static $origens  = array('à','á','â','ã','ç','é','ê','í','ì','ó',
    'ô','õ','ù','ú','û','À','Á','Â','Ã','Ç','É','Ê',
    'Ì','Í','Î','Ò','Ó','Ô','Õ','Ù','Ú');

  private static $destinos = array('a','a','a','a','c','e','e','i','i','o',
    'o','o','u','u','u','A','A','A','A','C','E','E',
    'I','I','I','O;','O','O','O','U','U'); 

  public static function convertOnUrl($data){
    
    if( \is_array($data) ){
      self::$data = \implode('', $data);
    }else{
      self::$data = $data;
    }
    self::$data = \explode(" ", \strtolower(str_replace(self::$origens, self::$destinos, self::$data)));
    return \implode("-", self::$data);
  }

}