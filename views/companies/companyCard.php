<?php
use yii\helpers\Html;
use app\models\Status;
?>
<div class="org-pane">
    <div class="org-head">
        <p><a href="/companies/view?id=<?= Html::encode($model->id) ?>"><?= Html::encode($model->name) ?></a></p>
    </div>
    <div class="org-body align-self-stretch">
        <p class="text-truncate"><?= Html::encode($model->getAttributeLabel('inn') . ': ' . $model->inn) ?></p>
        <p class="text-truncate"><?= Html::encode($model->getAttributeLabel('adress') . ': ' . $model->adress) ?></p>
        <p class="text-truncate"><?= Html::encode($model->getAttributeLabel('director') . ': ' . $model->director) ?></p>
    </div>
    <div class="org-footer d-flex justify-content-end">
        <span class="mr-auto"><?= Html::encode($model->getAttributeLabel('status') . ": " . Status::item($model->status))?></span>
        <a href="/companies/view?id=<?= Html::encode($model->id) ?>"
           class="btn btn-primary ml-auto align-right">Подробнее
        </a>
    </div>
</div>
