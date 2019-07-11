<?php

/* @var $this yii\web\View */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
use yii\web\View;

?>
<div class="car-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Если вы видите "Дайте id", то, скорее всего, не дали в GET id, а если "Response:OK" или страшная штука на 3 строки, то это был post запрос:
        <?= $json?>

    </p>

    <code><?= __FILE__ ?></code>
</div>