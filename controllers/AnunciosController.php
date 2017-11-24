<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Anuncios;
use app\models\AnunciosSearch;
// Added class I'm go to using from down
use app\models\CadastroAnuncioForm;
use app\models\Cidades;
use app\models\Categorias;
use app\models\RedesSociais;
use app\models\AnunciosRedesSociais;
use app\models\Tags;
use app\models\AnunciosTags;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

/**
 * AnunciosController implements the CRUD actions for Anuncios model.
 */
class AnunciosController extends Controller
{
  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
        ],
      ],
      'access' => [
        'class' => \yii\filters\AccessControl::className(),
        'only' => ['create', 'update', 'delete'],
        'rules' => [
          // deny all POST requests
          [
            'allow' => false,
            'verbs' => ['POST']
          ],
          // allow authenticated users
          [
            'allow' => true,
            'roles' => ['@'],
          ],
          // everything else is denied
        ],
      ],
    ];
  }

  /**
   * Lists all Anuncios models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new AnunciosSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);

  }

  public function actionMostrar(){

    $query = Anuncios::find();

    $dataProvider = new ActiveDataProvider([

      'query'         => $query,
      'pagination'    => [
        'pageSize'    => 1,
      ],
      'sort'          => [

        'defaultOrder'=> [
          'titulo'    => SORT_ASC,
        ]

      ]

    ]);

    return $this->render('mostrar', [
      'dataProvider' => $dataProvider
    ]);

  }

  public function actionListar(){
    //$anuncios = new Anuncios();
    $query = Anuncios::find();
    // ->joinWith('anunciosRedesSociais')
    // //->asArray()
    // ->all();

    //echo '<pre>'; print_r($query); echo '</pre>';

    $pagination = new Pagination([
      'defaultPageSize' => 1,
      'totalCount' => $query->count(),
    ]);
    //print_r($pagination->totalCount);
    // limit the query using the pagination and retrieve the articles
    $anuncios = $query
      ->with('anunciosRedesSociais')
      ->asArray()
      ->offset($pagination->offset)
      ->limit($pagination->limit)
      ->all();

    return $this->render('listar',[
      'anuncios'    => $anuncios,
      'pagination'  => $pagination,
    ]);

  }

  /**
   * Displays a single Anuncios model.
   * @param integer $id
   * @param integer $bairro_id
   * @param integer $categoria_id
   * @return mixed
  */
  public function actionView($id, $bairro_id, $categoria_id)
  {
    return $this->render('view', [
      'model' => $this->findModel($id, $bairro_id, $categoria_id),
    ]);
  }

  /**
   * Creates a new Anuncios model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
  */
  public function actionCreate()
  {
    //$model = new Anuncios();

    $form = new CadastroAnuncioForm();
    // Carregar todas as cidades para atribuir a propriedade $id_cidade no _form
    $form->cidade_id = Cidades::find()->all();
    $form->categoria_id = Categorias::find()->all();
    $form->redesSociaisID = RedesSociais::find()->all();
    $form->tagsID = Tags::find()->all();
    if ( Yii::$app->request->isPost && $form->load(Yii::$app->request->post())  ) {
      $request = Yii::$app->request;
      // $headers is an object of yii\web\HeaderCollection
      //$headers = $request->headers;
      //$tagsIds = $request->post('AnunciosTags');
      //$tagsIds = $tagsIds['tag_id'];
      // echo '<pre>'; print_r( $request->post() ) ; echo '</pre>';
      // exit();

      $transaction = Yii::$app->db->beginTransaction();

      try {
        $model = new Anuncios();
        $model->titulo = $form->titulo;
        $model->slogan = $form->slogan;
        $model->texto = $form->texto;
        $model->telefone = $form->telefone;
        $model->endereco = $form->endereco;
        $model->site = $form->site;
        $model->bairro_id = $form->bairro_id;
        $model->categoria_id = $form->categoria_id;

        $model->save();

        $tags = $request->post('AnunciosTags', array());

        foreach($tags as $tag_id => $arrai){

          foreach($arrai as $tag){
            $anuncTags = new AnunciosTags();
            $anuncTags->anuncio_id = $model->id;
            $anuncTags->tag_id = $tag;
            ( !$anuncTags->save() ? $transaction->rollBack() : '' );
          }
          
        }

        $redesSociais = $request->post('AnunciosRedesSociais', array());

        foreach ($redesSociais as $redeSocial) {
          // Setando os atributos do model AnunciosRedesSociais
          $anunciosRedesSociais = new AnunciosRedesSociais();
          // Atributo anuncio_id pertence a tabela Anuncios relação N X N
          $anunciosRedesSociais->anuncio_id = $model->id;
          $anunciosRedesSociais->rede_social_id = $redeSocial['id'];
          $anunciosRedesSociais->url = $redeSocial['url'];

          (!$anunciosRedesSociais->save()) ? $transaction->rollBack() : '';

        }
        /*echo '<pre>';
          var_dump($anunciosRedesSociais);
        echo '</pre>';
        exit();*/
        $transaction->commit();

      }catch(Exception $e){
        $transaction->rollBack();
        throw $e;
      }

      return $this->redirect([
        'view',
        'id' => $model->id,
        'bairro_id' => $model->bairro_id,
        'categoria_id' => $model->categoria_id
      ]);

    } else {
      return $this->render('create', [
        'model' => $form,
      ]);
    }

  }

  /**
   * Updates an existing Anuncios model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @param integer $bairro_id
   * @param integer $categoria_id
   * @return mixed
  */
  public function actionUpdate($id, $bairro_id, $categoria_id)
  {
    $model = $this->findModel($id, $bairro_id, $categoria_id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id, 'bairro_id' => $model->bairro_id, 'categoria_id' => $model->categoria_id]);
    } else {
      return $this->render('update', [
        'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing Anuncios model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @param integer $bairro_id
   * @param integer $categoria_id
   * @return mixed
  */
  public function actionDelete($id, $bairro_id, $categoria_id)
  {
    $this->findModel($id, $bairro_id, $categoria_id)->delete();
    return $this->redirect(['index']);
  }

  /**
   * Finds the Anuncios model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @param integer $bairro_id
   * @param integer $categoria_id
   * @return Anuncios the loaded model
   * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($id, $bairro_id, $categoria_id)
  {
    if (($model = Anuncios::findOne(['id' => $id, 'bairro_id' => $bairro_id, 'categoria_id' => $categoria_id])) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

}
