<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yiier\humansLog\models\HLogTemplate;

/* @var $this yii\web\View */
/* @var $model yiier\humansLog\models\HLogTemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="search-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'method' => 'get',
        'action' => ['index']
    ]); ?>
    <?= $form->field($model, 'user_id')->textInput(['placeholder' => Yii::t('hlog', 'User ID')]) ?>

    <?= $form->field($model, 'username')->textInput(['placeholder' => Yii::t('hlog', 'Username')]) ?>

    <?= $form->field($model, 'h_log_template_id')->dropDownList(
        HLogTemplate::getIdAndTitleMap(),
        ['prompt' => Yii::t('hlog', 'All Log Template')]
    ) ?>

    <?= $form->field($model, 'createTimeStart')->input('date', ['placeholder' => Yii::t('hlog', 'Log')]) ?>

    <?= $form->field($model, 'createTimeEnd')->input('date', ['placeholder' => Yii::t('hlog', 'Log')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('hlog', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('hlog', 'Reset'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
