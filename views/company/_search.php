<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 mt-1 company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

        <div class="ml-auto">
            <div class="input-group input-group-md mb-1">
                <?= $form->field($model, 'name', ['options' => ['tag' => false], 'template' => '{input}'])->textInput()->input('name', ['placeholder' => "Название"])->label(false) ?>

                <?= $form->field($model, 'inn', ['options' => ['tag' => false], 'template' => '{input}'])->textInput()->input('inn', ['placeholder' => "ИНН"])->label(false) ?>

                <?= $form->field($model, 'director', ['options' => ['tag' => false], 'template' => '{input}'])->textInput()->input('director', ['placeholder' => "Директор"])->label(false) ?>

                <?= $form->field($model, 'adress', ['options' => ['tag' => false], 'template' => '{input}'])->textInput()->input('adress', ['placeholder' => "Адрес"])->label(false) ?>

                <?= Html::submitButton('Search', ['class' => 'btn btn-dark']) ?>

                <?= Html::resetButton('Reset', ['class' => 'btn btn-warning']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>

