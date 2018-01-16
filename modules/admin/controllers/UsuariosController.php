<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\DBUsuarios;
use app\models\DBUsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\ValidadorUsuarios;

/**
 * DBUsuariosController implements the CRUD actions for DBUsuarios model.
 */
class UsuariosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update'],
                'rules' => [                  
                  [
                    'actions' => ['index', 'create'],
                    'allow' => true,
                    'matchCallback' => function ($rule, $action){
                        if (Yii::$app->user->isGuest)
                            return false;
                        elseif (!Yii::$app->user->identity->admin)
                            return false;
                        else
                            return true;
                    },
                  ], 
                  [
                    'actions' => ['update'],
                    'allow' => true,
                    'matchCallback' => function ($rule, $action){
                        
                    },
                  ],                 
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DBUsuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DBUsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DBUsuarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DBUsuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //echo '<pre>'; print_r( Yii::$app->homeUrl ) ; echo '</pre>';die;
        $model = new DBUsuarios();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            Yii::$app->session->setFlash('usuarioFormSubmitted');

            $transaction = Yii::$app->db->beginTransaction();
            
            try {
                $user = new User();
                $model->password = $user->setPassword($model->password);
                $model->save();
                
                $valUsuario = new ValidadorUsuarios();
                $valUsuario->usuario_id = $model->id; 
                $strRamdom = Yii::$app->security->generateRandomString();
                $valUsuario->key = $strRamdom;
                
                if( $valUsuario->validate() && $valUsuario->save() ){
                    
                    $url = "http://yii2/validador-usuarios/validar?key=".$strRamdom;
                    $content = "<p>Obrigado por se cadastrar na plataforma de busca ";
                    $content .= "de comêrcios e profissionais autonômos Encontra ABC para ";
                    $content .= "ativar sua conta basta clicar no link abaixo e fazer ótimos ";
                    $content .= "negocios</p> <a href='{$url}'>{$url}</a>";
                
                    Yii::$app->mailer->compose('@app/mail/layouts/html',['content'=>$content])
                    ->setTo($model->email)
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setSubject('Cadastro Encontra ABC')
                    ->setHtmlBody($content)
                    ->send();
    
                }
                
                $transaction->commit();

            }catch(Exception $e){
                $transaction->rollBack();
                throw $e;
            }

            return $this->refresh();

        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DBUsuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DBUsuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DBUsuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DBUsuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DBUsuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
