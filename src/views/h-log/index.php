<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yiier\humansLog\Module;

/* @var $this yii\web\View */
/* @var $searchModel yiier\humansLog\models\HLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('hlog', 'Log');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginContent(Module::getInstance()->mainLayout) ?>
<?php $style = <<< CSS
pre {
    background-color:transparent;
    border:none;
    margin:0;
    padding: 4px;
}

CSS;
$this->registerCss($style);
?>
<div class="hlog-index">

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin([
        'scrollTo' => 0,
        'formSelector' => false,
        'linkSelector' => '.pagination a'
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{summary}\n{pager}",
        'options' => [
            'class' => 'grid-view table-responsive hlog-grid'
        ],
        'columns' => [
            [
                'attribute' => 'h_log_template_id',
            ],
            [
                'attribute' => 'user_id',
            ],
            [
                'attribute' => 'username',
            ],
            [
                'attribute' => 'fk',
            ],
            [
                'attribute' => 'log',
                'format' => 'html',
                'value' => function (\yiier\humansLog\models\HLog $model) {
                    return "<pre title=\"ID:{$model->id}\"><code>{$model->log}</code></pre>";
                }
//                'options' => ['width' => '100px'],
            ],
//            'log',
            [
                'attribute' => 'created_at',
                'options' => ['width' => '150px'],
                'value' => function ($data) {
                    return Yii::$app->formatter->asDatetime($data->created_at);
                },
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php $this->endContent() ?>
