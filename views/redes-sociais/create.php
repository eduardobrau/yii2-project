<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RedesSociais */

$this->title = 'Create Redes Sociais';
$this->params['breadcrumbs'][] = ['label' => 'Redes Sociais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redes-sociais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
