<?php

use yiier\humansLog\Module;


/* @var $this yii\web\View */
/* @var $model yiier\humansLog\models\HLogTemplate */

$this->title = Yii::t('hlog', 'Create Log Template');
$this->params['breadcrumbs'][] = ['label' => Yii::t('hlog', 'Log Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginContent(Module::getInstance()->mainLayout) ?>

<div class="hlog-template-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php $this->endContent() ?>
