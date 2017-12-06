<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yiier\humansLog\models\HLogTemplate */

$this->title = Yii::t('app', '更新{modelClass}: ', [
    'modelClass' => '日志模板',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hlog Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="hlog-template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
