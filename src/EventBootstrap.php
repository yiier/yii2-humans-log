<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2019/4/27 9:15 PM
 * description:
 */

namespace yiier\humansLog;

use yii\base\BootstrapInterface;
use yii\base\Controller;
use yii\base\Event;
use yii\db\ActiveRecord;

class EventBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $activeRecordEvents = [
            ActiveRecord::EVENT_AFTER_VALIDATE,
        ];

        $controllerEvents = [
            Controller::EVENT_BEFORE_ACTION,
        ];

        foreach ($activeRecordEvents as $eventName) {
            Event::on(ActiveRecord::className(), $eventName, function ($event) {
                /** @var ActiveRecord $model */
                $model = $event->sender;
                $model->attachBehavior('hlog', [
                    'class' => HLogBehavior::className(),
                ]);
            });
        }

        foreach ($controllerEvents as $eventName) {
            Event::on(Controller::className(), $eventName, function ($event) {
                /** @var Controller $controller */
                $controller = $event->sender;
                $controller->attachBehavior('hlog', [
                    'class' => HLogBehavior::className(),
                ]);
            });
        }
    }
}