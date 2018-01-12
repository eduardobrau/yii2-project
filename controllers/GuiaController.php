<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Anuncios;
use app\models\Cidades;
use yii\web\NotFoundHttpException;

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
  /**
   * Sempre será executado quando a rota coincidir com
   * yii2/guia/{slug} isso já foi definido em rules de config/web.
   * Esperando que seja uma Cidade valida, faz a consulta na tabela
   * Cidades baseado no slug e seta o cidade_id pela propriedade retornada.
   */
  public function actionCidade($slug){
    
    //Retorna uma linha do objeto Cidades baseado no slug
    $cidade = $this->findModelBySlug($slug);
    $model = new Anuncios();
    //Seta $cidade_id dinamicamente, conforme o slug passado via GET da URL
    $cidade_id = $cidade->id;
    //Faz uma busca por todos os anuncios baseado no id da Cidade
    //e retorna um array com os anuncios e paginação
    $dados = $model->getAnuncios($cidade_id);

    return $this->render('cidade', $dados);

  }

  /**
   * Finds the Cidades model based on its slug value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Cidades the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModelBySlug($slug)
  {
    if (($model = Cidades::find()->where(['slug'=>$slug])->one()) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

}