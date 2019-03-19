<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?= $this->render('_search', ['model' => $searchModel,'sort'=>$sort]); ?>

    <?php
    $columns = 3;
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}<div class="col-12">{pager}</div>',
        'itemOptions' => ['class' => "col-lg-4 col-md-6 col-xs-10 org-cont"],
        'itemView' => 'companyCard',
        'options' => ['class' => 'container d-flex flex-wrap align-items-stretch justify-content-between'],
        'pager' => [
            'options' => [
                'tag' => 'div',
                'class' => 'pagination',
                'id' => 'pager-container',
            ],
            'linkOptions' => ['class' => 'page-link'],
            'prevPageLabel' => '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>',
            'nextPageLabel' => '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>',
            'activePageCssClass' => 'page-item active',
            'disabledPageCssClass' => 'disabled page-link',
            'prevPageCssClass' => 'page-item',
            'nextPageCssClass' => 'page-item',
        ],
    ]);
    Pjax::end(); ?>
</div>
