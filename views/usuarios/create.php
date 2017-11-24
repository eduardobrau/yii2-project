<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DBUsuarios */

$this->title = 'Novo Usuário';
$this->params['breadcrumbs'][] = ['label' => 'Usuário', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dbusuarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
