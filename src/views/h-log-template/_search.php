<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

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
    <?= $form->field($model, 'title')->textInput(['placeholder' => Yii::t('hlog', 'Title')]) ?>

    <?= $form->field($model, 'unique_id')->textInput(['placeholder' => Yii::t('hlog', 'Unique ID')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('hlog', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('hlog', 'Reset'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
