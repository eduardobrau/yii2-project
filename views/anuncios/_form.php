<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Cidades;
//use yii\helpers\VarDumper;
//echo '<pre>'; print_r($model->tagsID); echo '</pre>';
//echo '<pre>'; VarDumper::dump($model); echo '</pre>';

/* @var $this yii\web\View */
/* @var $model app\models\Anuncios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncios-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= Html::input('hidden', 'CadastroAnuncioForm[usuario_id]', Yii::$app->user->id) ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slogan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <label for="sel1">Selecione até 5 Palavras Chaves com CTRL + click:</label>
        <select name="AnunciosTags['tag_id'][]" multiple="multiple" class="form-control">
            <?php foreach ($model->tagsID as $key => $value) {
                echo '<option value="'.$value->id.'">' .$value->tag. '</option>';
            } ?>
        </select>
    </div>

    <?= $form->field($model, 'categoria_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(
                    $model->categoria_id,
                    'id',
                    'categoria'
            ),
            [
                    'prompt'=>'Selecione uma categoria'
            ]
    ) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endereco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cidade_id')->dropDownList(
        ArrayHelper::map(
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

    <div class="form-group">
        <?php /* Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) */?>
    </div>
    <fieldset class="form-group">
        <legend>Redes Sociais</legend>
    <?php foreach ($model['redesSociaisID'] as $index => $redeSocial){ ?>
        <div class="form-group form-inline">
            <label for="exampleInputName2"><?= ++$index.'.'.$redeSocial->rede_social?></label>
            <!-- type, input name, input value, options -->
            <?= Html::input('text', 'AnunciosRedesSociais['.$index.'][url]', '', ['class' => 'form-control'])?>
            <?= Html::input('hidden', 'AnunciosRedesSociais['.$index.'][id]', $redeSocial->id)?>
        </div>
    <?php } ?>
    </fieldset>
    <div class="form-group">
        <?= $form->field($model, 'imagens[]')->fileInput(['multiple' => true, 'accept' => 'image/*', 'class' => 'form-control']) ?>
        <?php // Html::fileInput('imagens[]', null, ['multiple' => true, 'accept' => 'image/*', 'class' => 'form-control'])?>
    </div>
    <?= Html::submitButton('Salvar', ['class' => 'btn btn-default']) ?>

  <?php ActiveForm::end(); ?>

</div>
