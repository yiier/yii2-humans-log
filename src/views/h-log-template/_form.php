<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yiier\humansLog\models\HLogTemplate;

/* @var $this yii\web\View */
/* @var $model yiier\humansLog\models\HLogTemplate */
/* @var $form yii\widgets\ActiveForm */

$uniqueIdHint = '只能是 <a href="http://www.yiiframework.com/doc-2.0/yii-base-action.html#getUniqueId()-detail">action uniqueId</a> 或者 <a href="http://www.yiiframework.com/doc-2.0/yii-base-baseobject.html#className()-detail">model className</a>，示例：<code>humans-log/h-log-template/index</code> 或者 <code>common\models\Account</code>';
$templateHint = '支持使用<code>{字段名}</code>代表数据表字段值，示例：删除文章 {title}。 <code>{h-log-request-url}</code>为系统约定的值，代表当然操作的 URL';
$methodHint = '当此值选择是<code>查看某条链接</code>时，下面的唯一标识的值只能为 <b>action uniqueId</b> 的类型，否则只能是 <b>model className</b> 的类型';
?>

<div class="hlog-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'method')->dropDownList(HLogTemplate::getMethods())->hint($methodHint) ?>

    <?= $form->field($model, 'unique_id')->textInput(['maxlength' => true])->hint($uniqueIdHint) ?>

    <?= $form->field($model, 'template')->textInput(['maxlength' => true])->hint($templateHint) ?>

    <?= $form->field($model, 'status')->dropDownList(HLogTemplate::getStatuses()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('hlog', 'Create') : Yii::t('hlog', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
