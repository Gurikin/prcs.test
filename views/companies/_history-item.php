<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="history">
    <b><?= Html::encode($model->name) ?></b>
    <p><?= Html::encode($model->inn) ?></p>
    <p><?= Html::encode($model->director) ?></p>
    <p><?= Html::encode($model->adress) ?></p>
</div>
