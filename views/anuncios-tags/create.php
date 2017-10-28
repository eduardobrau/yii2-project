<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AnunciosTags */

$this->title = 'Create Anuncios Tags';
$this->params['breadcrumbs'][] = ['label' => 'Anuncios Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncios-tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
