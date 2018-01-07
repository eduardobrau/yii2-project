<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Anuncios;

class GuiaController extends Controller{

  /**
   * Displays homepage.
   *
   * @return string
   */
  public function actionAbc()
  {
    return $this->render('abc');
  }

  public function actionSantoAndre()
  {
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 1;
    $dados = $model->getAnuncios($cidade_id);

    //$cidades['cidades'] = Cidades::find()->asArray()->all();

    //$anuncios = array_merge($dados,$cidades);

    return $this->render('santo-andre', $dados);
  }

  public function actionSaoBernardoDoCampo()
  {
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 2;
    $dados = $model->getAnuncios($cidade_id);

    return $this->render('sao-bernardo-do-campo', $dados);
  }

  public function actionSaoCaetano()
  {
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 3;
    $dados = $model->getAnuncios($cidade_id);

    return $this->render('sao-caetano', $dados);
  }

  public function actionDiadema()
  {
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 4;
    $dados = $model->getAnuncios($cidade_id);

    return $this->render('diadema', $dados);
  }

  public function actionMaua()
  {
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 5;
    $dados = $model->getAnuncios($cidade_id);

    return $this->render('maua', $dados);
  }

  public function actionRibeiraoPires()
  {
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 6;
    $dados = $model->getAnuncios($cidade_id);

    return $this->render('ribeirao-pires', $dados);
  }

  public function actionRioGrandeDaSerra()
  {
    $model = new Anuncios();
    $model->model = $model;
    $cidade_id = 7;
    $dados = $model->getAnuncios($cidade_id);

    return $this->render('rio-grande-da-serra', $dados);
  }


}