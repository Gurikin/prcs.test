<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'name',
        'company_id',
        'inn',
        'director',
        'adress:ntext',
        'status',
        'last_change',

        'actionColumn' => [
            'class' => ActionColumn::className(),
            'header' => 'Действия',
            'template' => '<div class="d-flex justify-content-center">{view}{update}{moderate}{denied}{delete}</div>',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<div class="text-center"><em data-toggle="tooltip"
                                                            data-placement="top" title="more detail"
                                                            class="fa fa-eye"></em></div>',
                        (new yii\grid\ActionColumn())->createUrl('admin/companies-history/view', $model, $model['id'], 1), [
                            'title' => Yii::t('yii', 'view'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                },
                'update' => function ($url, $model) {
                    return Html::a('<div class="text-center"><em data-toggle="tooltip"
                                                            data-placement="top" title="edit"
                                                            class="fa fa-pen"></em></div>',
                        (new yii\grid\ActionColumn())->createUrl('admin/companies-history/update', $model, $model['id'], 1), [
                            'title' => Yii::t('yii', 'view'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class' => ($model['status'] >= 1 && $model['status'] !== 3) ? 'btn-link disabled' : '',
                        ]);
                },
                'moderate' => function ($url, $model) {
                    return Html::a('<div class="text-center"><em data-toggle="tooltip"
                                                            data-placement="top" title="moderate"
                                                            class="fas fa-check"></em></div>',
                        (new yii\grid\ActionColumn())->createUrl('companies/moderate', $model, $model['company_id'], 1), [
                            'title' => Yii::t('yii', 'view'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class' => ($model['status'] >= 1 && $model['status'] !== 3) ? 'btn-link disabled' : '',
                        ]);
                },
                'denied' => function ($url, $model) {
                    return Html::a('<div class="text-center"><em data-toggle="tooltip"
                                                            data-placement="top" title="moderate"
                                                            class="fas fa-redo"></em></div>',
                        (new yii\grid\ActionColumn())->createUrl('admin/companies-history/denied-changes', $model, $model['id'], 1), [
                            'title' => Yii::t('yii', 'view'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class' => ($model['status'] >= 1 && $model['status'] !== 3) ? 'btn-link disabled' : '',
                        ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('<div class="text-center"><em data-toggle="tooltip"
                                                            data-placement="top" title="moderate"
                                                            class="far fa-trash-alt"></em></div>',
                        (new yii\grid\ActionColumn())->createUrl('admin/companies-history/delete', $model, $model['id'], 1), [
                            'title' => Yii::t('yii', 'view'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class' => ($model['status'] == 0 || $model['status'] > 3) ? 'btn-link disabled' : '',
                        ]);
                },
            ]
        ],
    ],
]);
?>