<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Anuncios;

class GuiaComercialController extends Controller{
  
  //http://yii2/guia-comercial/santo-andre/webdesign/21
  public function actionView($cidade=NULL,$titulo=NULL,$id){
    
    $anuncio = Anuncios::find()
    ->joinWith([
      'categoria',
      'bairro',
      'bairro.cidade',
      'anunciosTags',
      'anunciosTags.tag',
      'anunciosRedesSociais',
    ])
    ->where(['anuncios.id' => $id])
    ->one();
    
    return $this->render('view', ['anuncio' => $anuncio]);

  }

  public function actionSantoAndre(){
    
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 1;
    $pagSize = 10;
    $anuncios = $model->getAnuncios($cidade_id, $pagSize);

    return $this->render('santo-andre', $anuncios);

  }

  public function actionSaoBernardoDoCampo(){
    
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 2;
    $pagSize = 10;
    $anuncios = $model->getAnuncios($cidade_id, $pagSize);

    return $this->render('sao-bernardo-do-campo', $anuncios);

  }

  public function actionSaoCaetanoDoSul(){
    
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 3;
    $pagSize = 10;
    $anuncios = $model->getAnuncios($cidade_id, $pagSize);

    return $this->render('sao-caetano-do-sul', $anuncios);

  }

  public function actionDiadema(){
    
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 4;
    $pagSize = 10;
    $anuncios = $model->getAnuncios($cidade_id, $pagSize);

    return $this->render('diadema', $anuncios);

  }

  public function actionMaua(){
    
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 5;
    $pagSize = 10;
    $anuncios = $model->getAnuncios($cidade_id, $pagSize);

    return $this->render('maua', $anuncios);

  }

  public function actionRibeiraoPires(){
    
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 6;
    $pagSize = 10;
    $anuncios = $model->getAnuncios($cidade_id, $pagSize);

    return $this->render('ribeirao-pires', $anuncios);

  }

  public function actionRioGrandeDaSerra(){
    
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 7;
    $pagSize = 10;
    $anuncios = $model->getAnuncios($cidade_id, $pagSize);

    return $this->render('rio-grande-da-serra', $anuncios);

  }

}
