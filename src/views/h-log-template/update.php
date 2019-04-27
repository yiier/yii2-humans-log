<?php

use yiier\humansLog\Module;

/* @var $this yii\web\View */
/* @var $model yiier\humansLog\models\HLogTemplate */

$this->title = Yii::t('hlog', 'Update Log Template:') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('hlog', 'Log Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('hlog', 'Update');
?>

<?php $this->beginContent(Module::getInstance()->mainLayout) ?>

<div class="hlog-template-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php $this->endContent() ?>
