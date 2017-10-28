<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AnunciosRedesSociais */

$this->title = 'Create Anuncios Redes Sociais';
$this->params['breadcrumbs'][] = ['label' => 'Anuncios Redes Sociais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncios-redes-sociais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
