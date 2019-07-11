<?php

use yii\helpers\Html;
?>
<?= Html::tag('p','Отправит запрос на /car')?>
<?= Html::beginForm('/car')?>
<?= Html::input('text','name')?>
<?=Html::input('submit','Create car!')?>
<?= Html::endForm()?>