<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 17/12/06 15:06
 * description:
 */

namespace yiier\humansLog;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'yiier\humansLog\controllers';

    /**
     * @var string
     */
    public $mainLayout = '@yiier/humansLog/views/layout.php';

    public function init()
    {
        parent::init();
        if (!isset(Yii::$app->i18n->translations['hlog'])) {
            Yii::$app->i18n->translations['hlog'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@yiier/humansLog/messages'
            ];
        }
    }
}