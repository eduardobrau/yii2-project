<?php

use app\components\widgets\MapaWidget;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';

?>

<div class="site-index">

  <?= MapaWidget::widget() ?>

  <div class="body-content">
    <div class="row">
      <div class="col-lg-4">
        <h2>Heading</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
          dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
          ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
          fugiat nulla pariatur.</p>

        <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
      </div>
      <div class="col-lg-4">
        <h2>Pesquise pelo Mapa</h2>
        <img class="" src="<?=Yii::getAlias('@web')?>/img/mapa-encontra-abc.png" usemap="#encontraABC">
        <map name="encontraABC">
          <!--<area shape="rect" coords="149,458,455,835" href="" target="">-->
          <area data="city-s-caetano" shape="poly" coords="79,8,96,17,106,13,106,20,105,23,
          108,29,104,36,102,46,99,50,95,47,90,51,,82,51,76,44,79,8"
          href="/guia/sao-caetano-do-sul" target=""> 
          <area data="city-s-andre" shape="poly" coords="107,14,116,20,
          127,20,143,30,159,29,156,41,163,50,156,52,150,58,150,61,
          159,65,165,78,156,93,155,103,161,105,165,111,170,112,175,118,
          173,130,188,146,184,152,187,155,191,156,193,157,209,154,
          213,161,222,157,240,156,255,148,259,142,269,140,270,131,
          279,128,285,128,291,119,298,121,307,128,304,135,309,135,
          317,141,323,140,327,140,341,157,325,173,319,173,304,186,
          304,171,290,167,275,175,258,176,253,188,240,196,237,194,
          224,197,210,194,207,191,208,185,194,181,149,136,144,134,
          141,134,129,139,125,137,133,132,131,126,133,115,129,108,
          133,100,119,95,113,84,101,80,101,65,91,51,96,47,99,51,
          103,45,104,36,109,29,105,22,108,20,107,14" href="/guia/santo-andre" target="">
          <area data="city-s-b-campo" shape="poly" coords="91,51,101,65,101,80,113,84,
          119,95,132,100,129,108,133,115,131,126,133,132,125,137,
          ,129,139,141,134,150,137,194,181,208,185,207,191,210,194,
          224,197,211,205,204,205,197,210,200,213,197,221,201,222,
          196,228,188,231,183,240,178,237,175,247,163,259,160,258,
          148,274,130,276,118,291,105,298,102,307,95,313,90,315,
          88,313,85,318,72,326,51,331,55,322,53,318,53,315,55,311,
          48,301,51,297,52,294,54,286,47,258,47,239,33,228,33,217,
          35,204,41,195,42,185,44,175,35,157,21,142,17,124,19,123,
          42,130,51,128,55,125,57,113,69,101,71,94,79,87,79,71,
          68,75,61,71,63,65,59,63,54,68,48,62,65,54,75,45,82.5,51.5,
          91,51" href="/guia/sao-bernardo-do-campo" target="">
          <area data="city-diadema" shape="poly" coords="20,122, 
          33,115,39,110,47,104,40,100,33,90,33,83,37,61,46,59,48,62,
          54,68,59,63,63,63,61,71,68,75,79,71,79,87,71,94,69,101,57,113,
          55,125,51,128,42,130,20,122" href="guia/diadema" target="">
          <area data="city-maua" shape="poly" coords="159,30,163,30,
          174,43,181,43,192,46,199,45,208,44,209,40,216,47,229,36,
          229,28,237,25,239,19,249,24,242,31,235,48,244,70,238,70,
          233,72,224,81,211,76,192,97,184,100,182,101,169,112,165,112,
          161,105,155,103,156,93,165,78,159,65,150,61,150,58,156,52,
          163,50,156,41,159,30" href="/guia/maua" target="">
          <area data="city-rib-pires" shape="poly" coords="249,23,258,45,
          267,45,273,41,275,44,275,51,272,62,273,67,277,68,281,71,290,81,
          294,102,292,100,291,102,291,106,287,110,278,110,271,108,268,108,
          266,105,266,103,262,103,258,105,249,103,248,104,249,107,250,110,
          248,116,238,116,233,123,225,125,221,127,218,138,217,142,219,147,
          214,148,211,149,210,151,210,154,193,157,191,156,187,155,184,152,
          188,146,173,130,175,118,170,112,182,101,184,100,192,97,211,76,
          224,81,233,72,238,70,244,70,235,48,242,31,249,23" href="/guia/ribeirao-pires" target="">
          <area data="city-rio-g-serra" shape="poly" coords="294,102,296,102,
          297,98,301,98,301,104,299,111,298,120,292,118,284,127,278,128,
          270,131,269,137,268,140,262,139,258,142,255,147,240,155,
          229,156,221,157,213,161,210,154,210,151,211,149,214,148,
          219,147,217,142,218,138,221,127,225,125,233,123,238,116,
          248,116,250,110,249,107,248,104,249,103,258,105,262,103,
          266,103,266,105,268,108,271,108,278,110,287,110,291,106,
          291,102,292,100,294,102" href="/guia/rio-grande-da-serra" target="">
        </map>
      </div>
      <div class="col-lg-4">
        <h2>Heading</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
          dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
          ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
          fugiat nulla pariatur.
        </p>
        <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
      </div>
    </div>
  </div>
</div>