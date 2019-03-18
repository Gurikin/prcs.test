<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\admin\CompaniesHistory */

$this->title = 'Create Company';
$this->params['breadcrumbs'][] = ['label' => 'Companies Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
