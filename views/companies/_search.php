<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompaniesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cont-container">
    <div class="row d-flex align-items-center col-12 pt-2 pb-2 align-items-center">
        <div class="sort-container d-flex col-lg-4 col-md-4 col-sm-12 col-xs-12 justify-content-start">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <div class="input-group-prepend">
                    <span class="input-group-text">Упорядочить</span>
                </div>
                <?php echo $sort->link('name',['class'=>'btn btn-secondary text-nowrap']); ?>
                <?php echo $sort->link('inn',['class'=>'btn btn-secondary text-nowrap']); ?>
            </div>
        </div>
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

                    <?= $form->field($model, 'inn', ['options' => ['tag' => false], 'template' => '{input}'])->textInput()->input('inn', ['placeholder' => "ИНН",'max' => true])->label(false) ?>

                    <?= $form->field($model, 'director', ['options' => ['tag' => false], 'template' => '{input}'])->textInput()->input('director', ['placeholder' => "Директор"])->label(false) ?>

                    <?= $form->field($model, 'adress', ['options' => ['tag' => false], 'template' => '{input}'])->textInput()->input('adress', ['placeholder' => "Адрес"])->label(false) ?>

                    <?php if (!Yii::$app->user->isGuest) {echo ($form->field($model, 'status', ['options' => ['tag' => false], 'template' => '{input}'])->textInput()->input('status', ['placeholder' => "Статус"])->label(false));} ?>

                    <?= Html::submitButton('Search', ['class' => 'btn btn-dark']) ?>

                    <?= Html::resetButton('Reset', ['class' => 'btn btn-warning']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

