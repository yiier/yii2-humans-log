<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yiier\humansLog\models\HLogTemplate;

/* @var $this yii\web\View */
/* @var $model yiier\humansLog\models\HLogTemplate */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hlog Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hlog-template-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'unique_id',
            'template',
            [
                'attribute' => 'method',
                'value' => function ($data) {
                    return HLogTemplate::getMethods()[$data->method];
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return HLogTemplate::getStatuses()[$data->status];
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
