<?php

namespace app\controllers;

use Yii;
use app\models\AnunciosRedesSociais;
use app\models\AnunciosRedesSociaisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnunciosRedesSociaisController implements the CRUD actions for AnunciosRedesSociais model.
 */
class AnunciosRedesSociaisController extends Controller
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
     * Lists all AnunciosRedesSociais models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnunciosRedesSociaisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnunciosRedesSociais model.
     * @param integer $id
     * @param integer $anuncio_id
     * @param integer $rede_social_id
     * @return mixed
     */
    public function actionView($id, $anuncio_id, $rede_social_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $anuncio_id, $rede_social_id),
        ]);
    }

    /**
     * Creates a new AnunciosRedesSociais model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnunciosRedesSociais();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'anuncio_id' => $model->anuncio_id, 'rede_social_id' => $model->rede_social_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AnunciosRedesSociais model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $anuncio_id
     * @param integer $rede_social_id
     * @return mixed
     */
    public function actionUpdate($id, $anuncio_id, $rede_social_id)
    {
        $model = $this->findModel($id, $anuncio_id, $rede_social_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'anuncio_id' => $model->anuncio_id, 'rede_social_id' => $model->rede_social_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AnunciosRedesSociais model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $anuncio_id
     * @param integer $rede_social_id
     * @return mixed
     */
    public function actionDelete($id, $anuncio_id, $rede_social_id)
    {
        $this->findModel($id, $anuncio_id, $rede_social_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnunciosRedesSociais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $anuncio_id
     * @param integer $rede_social_id
     * @return AnunciosRedesSociais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $anuncio_id, $rede_social_id)
    {
        if (($model = AnunciosRedesSociais::findOne(['id' => $id, 'anuncio_id' => $anuncio_id, 'rede_social_id' => $rede_social_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
