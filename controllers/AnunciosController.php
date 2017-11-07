<?php

namespace app\controllers;

use Yii;
use app\models\Anuncios;
use app\models\AnunciosSearch;
// Added class I'm go to using from down
use app\models\CadastroAnuncioForm;
use app\models\Cidades;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
//        $model = new Anuncios();
//

      $form = new CadastroAnuncioForm();
      // Carregar todas as cidades para atribuir a propriedade $id_cidade no _form
      $form->cidade_id = Cidades::find()->all();

      if ($form->load(Yii::$app->request->post()) && $form->save()) {
        return $this->redirect(['view', 'id' => $form->id, 'bairro_id' => $form->bairro_id, 'categoria_id' => $form->categoria_id]);
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
