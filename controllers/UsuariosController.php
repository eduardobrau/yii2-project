<?php

namespace app\controllers;

use Yii;
use app\models\DBUsuarios;
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
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


}
