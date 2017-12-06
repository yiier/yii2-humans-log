<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yiier\humansLog\models\HLogTemplate;

/* @var $this yii\web\View */
/* @var $searchModel yiier\humansLog\models\HLogTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '日志模板');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hlog-template-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '创建日志模板'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <br>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
