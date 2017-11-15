<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Anuncios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anuncios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'bairro_id' => $model->bairro_id, 'categoria_id' => $model->categoria_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'bairro_id' => $model->bairro_id, 'categoria_id' => $model->categoria_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'titulo',
            'slogan',
            'texto:ntext',
            'telefone',
            'endereco',
            'site',
            //'bairro_id',
            'bairro.bairro',
            //'categoria_id',
            'categoria.categoria',
        ],

    ]) ?>

    <table class="table table-striped table-bordered detail-view" style="margin-top: -21px;">
    <tbody>
    <?php //   '<pre>'; var_dump($model->anunciosRedesSociais); '</pre>';
        foreach ($model->anunciosRedesSociais as $index => $value) {
            echo '<tr>';
            switch ($index) {
                case 0:
                    echo '<th style="width:89px;">Facebook: </th>' . '<td>' .$value['url'].'</td>';
                break;
                case 1:
                    echo '<th style="width:89px;">Twitter: </th>' . '<td>' .$value['url'].'</td>';
                break;
                case 2:
                    echo '<th style="width:89px;">Instagram: </th>' . '<td>' .$value['url'].'</td>';
                break;
                case 3:
                    echo '<th style="width:89px;">Google+: </th>' . '<td>' .$value['url'].'</td>';
                break;
                case 4:
                    echo '<th style="width:89px;">LinkedIn: </th>' . '<td>' .$value['url'].'</td>';
                break;
            }
            echo '</tr>';

        }
    ?>
    </tbody>
    </table>

</div>
