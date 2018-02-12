<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Cidades;
//use yii\helpers\VarDumper;
//echo '<pre>'; print_r($model->redes_sociais); echo '</pre>';die;
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
        <?php $model->setSelectedTags(); ?>
        <?=  $form->field($model, 'tags_id')->dropDownList(
            ArrayHelper::map(
                $model->tagsID,
                'id',
                'tag'
            ),
            [
                'multiple' => 'multiple',
                'selected' => 'selected',
                'id' => 'AnunciosTags-tag_id',
                'prompt'=>'Selecione até 3 palavras chaves',
            ]
        )  ?>
    </div>

    <?= $form->field($model, 'categoria_id')->dropDownList(
        
        ArrayHelper::map(
            $model->categoriasID,
            'id',
            'categoria'
        ),
        [
            'prompt'=>'Selecione uma categoria',
            'selected' => 'selected',
        ]
    ) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true,'class'=>'form-control phone_with_ddd']) ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endereco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cidade_id')->dropDownList(
        ArrayHelper::map(
          $model->cidadesID,
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
    <?php
    /**
     * Primeira regra deve ser passado um objeto como parametro
     * Esse objeto verifica se uma de suas propriedades tem valor
     * mas para isso essa deve ser chamada apenas dentro de um
     * array por exemplo $objeto[$key]->url na verdade está 
     * incapsulando $model->redes_sociais[$key]->url
     */
    function retornaUrl($redes_sociais,$ocorrencia){
       
        if( !empty($redes_sociais) ){
            //echo '<pre>'; print_r($redes_sociais); echo '</pre>';die;
            foreach ($redes_sociais as $key => $rede_social) {
                //echo '<pre>'; print_r($rede_social->rede_social_id); echo '</pre>';die;
                if( !empty($rede_social->url) && ($rede_social->rede_social_id == $ocorrencia) )
                    return $rede_social->url; 
            }
        }else
            return '';
         
    }
    ?>
    <fieldset class="form-group">
        <legend>Redes Sociais</legend>
    <?php foreach ($model->redesSociaisID as $index => $redeSocial){ ?>

        <div class="form-group">
            <label for="exampleInputName2"><?=$redeSocial->rede_social?></label>
            <!-- type, input name, input value, options -->
            <?= Html::input(
                'text',
                'AnunciosRedesSociais['.$index.'][url]',
                retornaUrl($model->redes_sociais, $redeSocial->id),
                ['class' => 'form-control'])?>
            <?= Html::input('hidden', 'AnunciosRedesSociais['.$index.'][id]', $redeSocial->id)?>
        </div>

    <?php } ?>
    </fieldset>
    <div class="form-group">
        <?php // $form->field($model, 'imagens[]')->fileInput(['multiple' => true, 'accept' => 'image/*', 'class' => 'form-control']) ?>
        <?php // Html::fileInput('imagens[]', null, ['multiple' => true, 'accept' => 'image/*', 'class' => 'form-control'])?>
    </div>
    <?= Html::submitButton('Salvar', ['class' => 'btn btn-default']) ?>

  <?php ActiveForm::end(); ?>

</div>
