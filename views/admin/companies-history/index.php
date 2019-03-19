<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\DataColumn;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\CompaniesHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies Histories';
$this->params['breadcrumbs'][] = $this->title;

$searchModel = isset($searchModel) ? $searchModel : null;
?>
<div class="companies-history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('@app/views/layouts/historyWidget', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel])?>
    <?php Pjax::end(); ?>
</div>
