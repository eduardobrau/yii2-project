<?php

namespace app\controllers;

use Yii;
use app\models\AnunciosTags;
use app\models\AnunciosTagsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnunciosTagsController implements the CRUD actions for AnunciosTags model.
 */
class AnunciosTagsController extends Controller
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
     * Lists all AnunciosTags models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnunciosTagsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnunciosTags model.
     * @param integer $id
     * @param integer $anuncio_id
     * @param integer $tag_id
     * @return mixed
     */
    public function actionView($id, $anuncio_id, $tag_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $anuncio_id, $tag_id),
        ]);
    }

    /**
     * Creates a new AnunciosTags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnunciosTags();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'anuncio_id' => $model->anuncio_id, 'tag_id' => $model->tag_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AnunciosTags model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $anuncio_id
     * @param integer $tag_id
     * @return mixed
     */
    public function actionUpdate($id, $anuncio_id, $tag_id)
    {
        $model = $this->findModel($id, $anuncio_id, $tag_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'anuncio_id' => $model->anuncio_id, 'tag_id' => $model->tag_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AnunciosTags model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $anuncio_id
     * @param integer $tag_id
     * @return mixed
     */
    public function actionDelete($id, $anuncio_id, $tag_id)
    {
        $this->findModel($id, $anuncio_id, $tag_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnunciosTags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $anuncio_id
     * @param integer $tag_id
     * @return AnunciosTags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $anuncio_id, $tag_id)
    {
        if (($model = AnunciosTags::findOne(['id' => $id, 'anuncio_id' => $anuncio_id, 'tag_id' => $tag_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
