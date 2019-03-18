<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\admin\CompaniesHistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-history-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'inn') ?>

    <?= $form->field($model, 'director') ?>

    <?= $form->field($model, 'adress') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'last_change') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
