<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Cidades;
//use yii\helpers\VarDumper;
//echo '<pre>'; var_dump($model); echo '</pre>';
//echo '<pre>'; VarDumper::dump($model); echo '</pre>';

/* @var $this yii\web\View */
/* @var $model app\models\Anuncios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slogan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endereco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cidade_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(
          /*Cidades::find()->all()*/$model->cidade_id,
          'id',
          'cidade'
        ),
        [
          'prompt'=>'Selecione uma Cidade',
          'id' => 'selectCity',
          'class'=>'form-control',
          'data-drop-change'=>'cadastroanuncioform-bairro_id',
          'data-action-url'=>Url::to(['bairros/listar-bairros'])
        ]
    )
    ?>

    <?= $form->field($model, 'bairro_id')->dropDownList([], ['prompt'=>'']) ?>

    <?= $form->field($model, 'categoria_id')->textInput() ?>

    <div class="form-group">
        <?php /* Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) */?>
    </div>

    <?php ActiveForm::end(); ?>

</div>