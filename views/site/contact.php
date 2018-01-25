<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\bootstrap\Alert;

$this->title = 'Contato';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12 body-wrap">

    <div class="body-content">
        <div class="row">
  
            <div class="col-md-8">
                <h1><?= Html::encode($this->title) ?></h1>

                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                    <div class="alert alert-success">
                        Obrigado por nos contactar. Responderemos seu email assim que possível, Obrigado pelo contato!.
                    </div>

                    <p>
                        Note that if you turn on the Yii debugger, you should be able
                        to view the mail message on the mail panel of the debugger.
                        <?php if (Yii::$app->mailer->useFileTransport): ?>
                            Because the application is in development mode, the email is not sent but saved as
                            a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                            Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                            application component to be false to enable email sending.
                        <?php endif; ?>
                    </p>

                <?php else: ?>

                    <?= Alert::widget([
                        'options' => [
                            'class' => 'alert-warning',
                        ],
                        'body' => "<p><strong>Atenção!</strong> Pedimos desculpa mas no momento não estamos recebendo e enviando email devido a restrição temporária imposta por nossa Hospedagem.</p>
                        <p>Caso ache conveniente nos envie um email através deste link:<a href='mailto:contato@encontraabc.com.br?Subject=Contato%20EncontraABC'> Enviar Email</a></p>",
                    ]);?>

                    <div class="row">
                        <div class="col-md-12">

                            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                                <?= $form->field($model, 'email') ?>

                                <?= $form->field($model, 'subject') ?>

                                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                    'template' => '<div class="row"><div class="col-md-2">{image}</div><div class="col-md-4">{input}</div></div>',
                                ]) ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                                </div>

                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>

                <?php endif; ?>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </div><!--/.body-content-->
</div><!--/.body-wrap-->