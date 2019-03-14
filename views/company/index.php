<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php
        $columns = 3;

        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'layout'       => '{items}<div class="col-12">{pager}</div>',
            'itemOptions'  => ['class' => "col-lg-6 col-md-6 col-xs-10 org-cont"],
            'itemView'     => 'companyCard',
            'options'      => ['class' => 'container d-flex flex-wrap align-items-stretch justify-content-between' ],
        ]);?>

        <?php Pjax::end(); ?>
</div>
