<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Companies */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
if (!Yii::$app->user->isGuest) {
    $footer = Yii::$app->getUser()->identity->role === 'admin' ? ''
        : '<div class="info-footer d-flex justify-content-end">
            <a href="/companies/update?id='
        . Html::encode($model->id)
        . '" class="btn btn-danger align-right">Update</a>
           </div>';
} else {
    $footer = '';
}

$searchModel = isset($searchModel) ? $searchModel : null;
?>
<div class="company-view container-fluid d-flex justify-content-center">
    <div class="col-lg-8 col-md-12 col-xs-12 right-content">
        <div class="info-block">
            <div class="info-header d-flex">
                <div class="info-head col-1"><i class="fa fa-info-circle fa-3x"></i></div>
                <div class="info-title col-11"><h1><?= Html::encode($this->title) ?></h1></div>
                <p> &nbsp; </p>
            </div>
            <div class="info-content">
                <?= DetailView::widget([
                    'model' => $model,
                    'template' => "<p><span class='mr-2'><b>{label}:</b></span><span>{value}</span></p>",
                    'attributes' => [
                        'name',
                        'inn',
                        'director',
                        'adress:ntext',
                    ],
                ]) ?>
                <p class="nbsp"> &nbsp; </p>
            </div>
            <?= $footer ?>
        </div>
    </div>
</div>
<?php
if (!Yii::$app->user->isGuest):?>
<hr>
<div class="container-fluid">
    <div class="history-block">
        <h3>История изменений <?= $this->title ?></h3>
        <?= $this->render('@app/views/layouts/historyWidget',
            ['dataProvider' => $dataProvider,
                'searchModel' => $searchModel])
        ?>
    </div>
</div>
<?php endif?>





