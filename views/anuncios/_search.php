<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnunciosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'slogan') ?>

    <?= $form->field($model, 'texto') ?>

    <?= $form->field($model, 'telefone') ?>

    <?php // echo $form->field($model, 'endereco') ?>

    <?php // echo $form->field($model, 'site') ?>

    <?php // echo $form->field($model, 'bairro_id') ?>

    <?php // echo $form->field($model, 'categoria_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
