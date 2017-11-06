<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <header id="topHeader">
        <div class="container">
            <div class="logoSite">
                <a href="#">
                  <?= Html::img('@web/images/', ['alt' => 'My logo']) ?>
                </a>
            </div>
        </div>
    </header>
  <?php
  NavBar::begin([
    //'brandLabel' => 'Myapp',
    'brandLabel' => false,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
      //'class' => 'navbar-inverse navbar-fixed-top',
      'class' => 'navbar-default',
    ],
  ]);
  echo Nav::widget([
    //'options' => ['class' => 'navbar-nav navbar-right'],
    'options' => ['class' => 'navbar-nav'],
    'items' => [
      ['label' => 'Inicio', 'url' => ['/site/index']],
      ['label' => 'Sobre', 'url' => ['about']],
      ['label' => 'Contato', 'url' => ['/site/contact']],
      Yii::$app->user->isGuest ? (
      ['label' => 'Login', 'url' => ['/site/login']]
      ) : (
        '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
          'Logout (' . Yii::$app->user->identity->username . ')',
          ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>'
      )
    ],
  ]);?>

    <form class="navbar-form navbar-right">

        <input type="text" id="tagText" class="form-control" placeholder="O que procura?">
        <select id="searchCategory" class="form-control">
            <option>Em qual categoria</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
        <select id="searchCountry" class="form-control">
            <option>Em qual cidade?</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
        <select id="searchBairro" class="form-control">
            <option>Em qual bairro?</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>

        <button type="submit" class="btn btn-default">Pesquisar</button>
    </form>

  <?php
  NavBar::end();
  ?>

    <div class="container">
      <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      ]) ?>
      <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
