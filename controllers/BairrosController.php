<?php

namespace app\controllers;

use Yii;
use app\models\Bairros;
use app\models\BairrosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// Adicionado devido usar retorno em Json
use yii\web\Response;

/**
 * BairrosController implements the CRUD actions for Bairros model.
 */
class BairrosController extends Controller
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
     * Lists all Bairros models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BairrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bairros model.
     * @param integer $id
     * @param integer $cidade_id
     * @return mixed
     */
    public function actionView($id, $cidade_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $cidade_id),
        ]);
    }

    /**
     * Creates a new Bairros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bairros();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'cidade_id' => $model->cidade_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Bairros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $cidade_id
     * @return mixed
     */
    public function actionUpdate($id, $cidade_id)
    {
        $model = $this->findModel($id, $cidade_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'cidade_id' => $model->cidade_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Bairros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $cidade_id
     * @return mixed
     */
    public function actionDelete($id, $cidade_id)
    {
        $this->findModel($id, $cidade_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bairros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $cidade_id
     * @return Bairros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $cidade_id)
    {
        if (($model = Bairros::findOne(['id' => $id, 'cidade_id' => $cidade_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionListarBairros($cidade_id)
    {
      Yii::$app->response->format = Response::FORMAT_JSON;
      return Bairros::find()->where(['cidade_id'=>$cidade_id])->select('id value, bairro text')->asArray()->all();
    }

}
