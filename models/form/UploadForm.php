<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model{

  public $imagens;

  public function rules(){
    return [
      [['imagens'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 3],
    ];
  }

  public function attributeLabels(){
    return [
    ];
  }

  public function upload(){

    if ($this->validate()) {

      foreach ($this->imagens as $file) {
        $strRamdom = Yii::$app->security->generateRandomString();
        $file->saveAs("uploads/{$file->baseName}-{$strRamdom}.{$file->extension}");
      }

      return true;

    }else {
      return false;
    }

  }

}

