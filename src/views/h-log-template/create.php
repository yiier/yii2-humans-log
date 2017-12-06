<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model yiier\humansLog\models\HLogTemplate */

$this->title = Yii::t('app', '添加日志模板');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hlog Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hlog-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
