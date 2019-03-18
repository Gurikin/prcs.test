<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\CompaniesHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'inn',
            'director',
            'adress:ntext',
            'status',
            'last_change',

            'actionColumn' => [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{view}{update}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return \yii\helpers\Html::a('<div class="text-center"><em data-toggle="tooltip"
                                                            data-placement="top" title="more detail"
                                                            class="fa fa-eye"></em></div>',
                            (new yii\grid\ActionColumn())->createUrl('admin/companies-history/view', $model, $model['id'], 1), [
                                'title' => Yii::t('yii', 'view'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                    },
                    'update' => function ($url, $model) {
                        return \yii\helpers\Html::a('<div class="text-center"><em data-toggle="tooltip"
                                                            data-placement="top" title="more detail"
                                                            class="fa fa-pen"></em></div>',
                            (new yii\grid\ActionColumn())->createUrl('admin/companies-history/update', $model, $model['id'], 1), [
                                'title' => Yii::t('yii', 'view'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
