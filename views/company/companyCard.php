<?php
use yii\helpers\Html;
?>
<div class="org-pane">
    <div class="org-head">
        <p><a href="/spravochnik/aero-avtozapravochnye-stancii-azs-agzs.html"><?= Html::encode($model->name) ?></a></p>
    </div>
    <div class="org-body align-self-stretch">
        <p class="text-truncate">ИНН: <?= Html::encode($model->inn) ?></p>
        <p class="text-truncate">Адрес: <?= Html::encode($model->adress) ?></p>
        <p class="text-truncate">Директор: <?= Html::encode($model->director) ?></p>
    </div>
    <div class="org-footer d-flex justify-content-end">
        <a href="/company/view?id=<?= Html::encode($model->inn) ?>"
           class="btn btn-primary align-right">Подробнее
        </a>
    </div>
</div>
