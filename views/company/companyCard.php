<?php
use yii\helpers\Html;
?>
<div class="org-pane">
    <div class="org-head">
        <p><a href="/spravochnik/aero-avtozapravochnye-stancii-azs-agzs.html"><?= Html::encode($model->name) ?></a></p>
    </div>
    <div class="org-body">
        <p>ИНН: <?= Html::encode($model->inn) ?></p>
        <p>Адрес: <?= Html::encode($model->adress) ?></p>
        <p>Директор: <?= Html::encode($model->director) ?></p>
    </div>
    <div class="org-footer d-flex justify-content-end">
        <a href="/company/view?id=<?= Html::encode($model->id) ?>" id="warning-109749"
           class="btn btn-primary align-right">Подробнее
        </a>
    </div>
</div>
