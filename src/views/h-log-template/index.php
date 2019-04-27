<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yiier\humansLog\models\HLogTemplate;
use yiier\humansLog\Module;

/* @var $this yii\web\View */
/* @var $searchModel yiier\humansLog\models\HLogTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('hlog', 'Log Templates');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginContent(Module::getInstance()->mainLayout) ?>

<div class="hlog-template-index">

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('hlog', 'Create Log Template'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <br>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{summary}\n{pager}",
        'options' => [
            'class' => 'grid-view table-responsive hlog-grid'
        ],
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['width' => '50px'],
            ],
            'title',
            [
                'attribute' => 'unique_id',
                'options' => ['width' => '300px'],
            ],
            'template',
            [
                'attribute' => 'method',
                'options' => ['width' => '100px'],
                'value' => function ($data) {
                    return HLogTemplate::getMethods()[$data->method];
                },
            ],
            [
                'attribute' => 'status',
                'options' => ['width' => '50px'],
                'value' => function ($data) {
                    return HLogTemplate::getStatuses()[$data->status];
                },
            ],

            [
                'attribute' => 'created_at',
                'options' => ['width' => '150px'],
                'value' => function ($data) {
                    return Yii::$app->formatter->asDatetime($data->created_at);
                },
            ],
            [
                'attribute' => 'updated_at',
                'options' => ['width' => '150px'],
                'value' => function ($data) {
                    return Yii::$app->formatter->asDatetime($data->updated_at);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['width' => '80px'],
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php $this->endContent() ?>
