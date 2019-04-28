<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yiier\humansLog\models\HLogTemplate;

/* @var $this yii\web\View */
/* @var $model yiier\humansLog\models\HLogTemplate */
/* @var $form yii\widgets\ActiveForm */

$uniqueIdHint = '只能是 <a href="http://www.yiiframework.com/doc-2.0/yii-base-action.html#getUniqueId()-detail">action uniqueId</a> 和 <a href="http://www.yiiframework.com/doc-2.0/yii-base-baseobject.html#className()-detail">model className </a>或者其他自定义唯一标识符，示例：<code>humans-log/h-log-template/index</code> 、 <code>common\models\Account</code> 或者 <code>afterLogin</code>';
$templateHint = '支持使用<code>{字段名}</code>代表数据表字段值，示例：删除文章 {title}。 <code>{h-log-request-url}</code>为系统约定的值，代表当然操作的 URL。 <code>{old-data}</code>为 <b>model className</b> 修改之前的 json 数据。';
$methodHint = '当此值选择是<code>' . Yii::t('hlog', 'Method View') . '</code>时，下面的唯一标识的值只能为 <b>action uniqueId</b> 的类型 。
当此值选择是<code>' . Yii::t('hlog', 'Method Other') . '</code>时，下面的唯一标识的值只能为 <code>自定义唯一标识符</code> 的类型。
否则只能是 <code>model className</code> 类型';
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
