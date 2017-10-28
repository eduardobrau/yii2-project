<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RedesSociais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="redes-sociais-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rede_social')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
