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
use app\models\form\UploadForm;
use yii\web\UploadedFile;
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
        /* The only option specifies that the Access Control Filter
        should only be applied to the index, update, create and delete actions.
        All other actions in the site controller are not subject to the access
        control. */
        'only' => ['index','update','create','delete'],
        /* While a user is requesting to execute an action, ACF will check a list
        of access rules to determine if the user is allowed to access the
        requested action. */
        'rules' => [
          // deny all POST requests
          [
            'actions' => ['index','listar'],
            'allow' => true,
            'matchCallback' => function ($rule, $action){
              if (Yii::$app->user->isGuest)
                return false;
              elseif (Yii::$app->user->identity->admin)
                return true;
              else
                return false;
            }
          ],
          // allow authenticated users
          [
            'allow' => true,
            'actions' => ['update','create','delete'],
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
  public function actionView($id)
  {
    return $this->render('view', [
      'model' => $this->findModel($id),
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
    $form->cidadesID = Cidades::find()->orderBy(['cidade'=>SORT_ASC])->all();
    $form->categoriasID = Categorias::find()->orderBy(['categoria'=>SORT_ASC])->all();
    $form->redesSociaisID = RedesSociais::find()->orderBy(['rede_social'=>SORT_ASC])->all();
    $form->tagsID = Tags::find()->orderBy(['tag'=>SORT_ASC])->all();
    
    if ( Yii::$app->request->isPost && $form->load(Yii::$app->request->post())  ) {
      $request = Yii::$app->request;
      //echo '<pre>'; print_r($request->post()); echo '</pre>';die;
      
      /* Carrega todos atributos $_POST['CadastroAnuncioForm']
      e faz um parsing para object já que o construtor espera um objeto*/
      $anuncioForm = (object) $request->post('CadastroAnuncioForm');
      /* Antes de destruir as propriedades que não fazem parte do
      Objeto Anuncios, aloco em uma variavel local para depois sim
      salvar no model AnunciosTags relação NxN entre Anuncios e Tags */
      $tags_id = (isset($anuncioForm->tags_id)) ? $anuncioForm->tags_id : [];
      // Distroi as propriedades que não existe no model Anuncios
      unset($anuncioForm->cidade_id, $anuncioForm->tags_id);

      $transaction = Yii::$app->db->beginTransaction();

      try {
        //echo '<pre>'; print_r($anuncioForm); echo '</pre>';die;
        $model = new Anuncios($anuncioForm);
        
        $model->save();

        //$tags = $request->post('AnunciosTags', array());

        foreach($tags_id as $tag_id){
          $anuncTags = new AnunciosTags();
          $anuncTags->anuncio_id = $model->id;
          $anuncTags->tag_id = $tag_id;
          ( !$anuncTags->save() ? $transaction->rollBack() : '' );
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

        $transaction->commit();

      }catch(Exception $e){
        $transaction->rollBack();
        throw $e;
      }

      return $this->redirect([
        'view',
        'id' => $model->id,
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
  public function actionUpdate($id)
  {
    //Recebe uma instancia especifica do objeto Anuncio
    $anuncio = $this->findModel($id);
    $model = new CadastroAnuncioForm();
    // Seta os novos valores que veio do form no $anuncio
    $model->id = $anuncio->id;
    $model->titulo = $anuncio->titulo;
    $model->slogan = $anuncio->slogan;
    $model->texto = $anuncio->texto;
    $model->telefone = $anuncio->telefone;
    $model->site = $anuncio->site;
    $model->endereco = $anuncio->endereco;
    $model->status = $anuncio->status;
    $model->bairro_id = $anuncio->bairro_id;
    $model->categoria_id = $anuncio->categoria_id;
    $model->usuario_id = $anuncio->usuario_id;

    // Recebe todas as Redes Sociais que já estão salvas para este anuncio
    $model->redes_sociais = $anuncio->anunciosRedesSociais;
    
    /* Carrega todas as instancias dos objetos abaixo para
    preencher os campos do formulário */
    $model->cidadesID = Cidades::find()->orderBy(['cidade' => SORT_ASC])->all();
    $model->categoriasID = Categorias::find()->orderBy(['categoria' => SORT_ASC])->all();
    $model->redesSociaisID = RedesSociais::find()->orderBy(['rede_social' => SORT_ASC])->all();
    $model->tagsID = Tags::find()->orderBy(['tag' => SORT_ASC])->all();

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      
      $anuncio->id = $model->id;
      $anuncio->titulo = $model->titulo;
      $anuncio->slogan = $model->slogan;
      $anuncio->texto = $model->texto;
      $anuncio->telefone = $model->telefone;
      $anuncio->site = $model->site;
      $anuncio->endereco = $model->endereco;
      $anuncio->status = $model->status;
      $anuncio->bairro_id = $model->bairro_id;
      $anuncio->categoria_id = $model->categoria_id;
      $anuncio->usuario_id = $model->usuario_id;
      // Discarta todos os dados que só eram necessário para montar o form
      unset($model->cidade_id, $model->cidadesID,$model->categoriasID,$model->redesSociaisID,$model->tagsID);
      // Inicia a transação caso algum objeto não seja salvo desfaz toda a transação
      $transaction = Yii::$app->db->beginTransaction();

      try{
        /**
         * Tenta salvar os dados do model Anuncios para depois salvar
         * os dados das tabelas NxN note que se qualquer operação
         * dentro desse bloco try{} falhar nada é salvo
        */
        $anuncio->save();
        /**
         * $tags->delete() retorna um booleano true se sucesso
         * Deleta todas as tags salva no relacionamento NxN entre
         * Anuncio e AnunciosTags
        * */
        foreach ($anuncio->anunciosTags as $tags) {
          $tags->delete();
        }
        /**
         * Retorna todas as tags setada em CadastroAnuncioForm em forma de
         * array 
         * */ 
        $tags_id = $model->tags_id;
        /**
         * Salva as novas tags selecionada no form, isso depois de deletar
         *  as tags do relacionamento NxN
        * */ 
        foreach($tags_id as $tag_id){
          $anuncTags = new AnunciosTags();
          $anuncTags->anuncio_id = $anuncio->id;
          $anuncTags->tag_id = $tag_id;
          ( !$anuncTags->save() ? $transaction->rollBack() : '' );
        }
        
        foreach($model->redes_sociais as $rSocial){
          $rSocial->delete();
        }
        
        $redesSociais = Yii::$app->request->post('AnunciosRedesSociais');
        
        foreach ($redesSociais as $redeSocial) {
          // Setando os atributos do model AnunciosRedesSociais
          $anunciosRedesSociais = new AnunciosRedesSociais();
          // Atributo anuncio_id pertence a tabela Anuncios relação N X N
          $anunciosRedesSociais->anuncio_id = $anuncio->id;
          $anunciosRedesSociais->rede_social_id = $redeSocial['id'];
          $anunciosRedesSociais->url = $redeSocial['url'];

          (!$anunciosRedesSociais->save()) ? $transaction->rollBack() : '';

        }

        $transaction->commit();

      }catch(Exception $e){
        $transaction->rollBack();
        throw $e;
      }

      return $this->redirect(['view', 'id' => $model->id]);

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
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();
    return $this->redirect(['index']);
  }

  public function actionPesquisar($tag_id=NULL, $categoria_id=NUll, $cidade_id=NULL, $bairro_id=NULL){
    
    $model = new Anuncios();

    $dataProvider = new ActiveDataProvider([
      'query' => $model->pesquisar($tag_id, $categoria_id, $cidade_id, $bairro_id),
      'pagination' => [
        'pageSize' => 5,
      ],
    ]);

    return $this->render('pesquisar', ['anuncios' => $dataProvider]);

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
  protected function findModel($id)
  {
    if (($model = Anuncios::findOne(['id' => $id])) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

}
