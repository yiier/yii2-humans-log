<?php

/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 17/12/06 15:36
 * description:
 */

namespace yiier\humansLog;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\web\Controller;
use Yii;
use yiier\humansLog\models\HLog;
use yiier\humansLog\models\HLogTemplate;

class HLogBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            Controller::EVENT_AFTER_ACTION => 'afterAction',
        ];
    }

    /**
     * Controller 请求操作
     * @return bool
     */
    public function afterAction()
    {
        // 只能是 GET
        if (!Yii::$app->user->isGuest && Yii::$app->request->method == 'GET') {
            $uniqueId = Yii::$app->controller->action->uniqueId;
            if ($hLogTemplate = $this->getHLogTemplate($uniqueId, HLogTemplate::METHOD_VIEW)) {
                $this->update($hLogTemplate);
            }
        }
        return false;
    }

    /**
     * Model 插入操作
     * @return bool
     */
    public function afterInsert()
    {
        if (!Yii::$app->user->isGuest) {
            $uniqueId = get_class($this->owner);
            if ($hLogTemplate = $this->getHLogTemplate($uniqueId, HLogTemplate::METHOD_INSERT)) {
                $this->update($hLogTemplate);
            }
        }
        return false;
    }

    /**
     * Model 更新操作
     * @return bool
     */
    public function afterUpdate()
    {
        if (!Yii::$app->user->isGuest) {
            $uniqueId = get_class($this->owner);
            if ($hLogTemplate = $this->getHLogTemplate($uniqueId, HLogTemplate::METHOD_UPDATE)) {
                $this->update($hLogTemplate);
            }
        }
        return false;
    }

    /**
     * Model 删除操作
     * @return bool
     */
    public function afterDelete()
    {
        if (!Yii::$app->user->isGuest) {
            $uniqueId = get_class($this->owner);
            if ($hLogTemplate = $this->getHLogTemplate($uniqueId, HLogTemplate::METHOD_DELETE)) {
                $this->update($hLogTemplate);
            }
        }
        return false;
    }

    /**
     * @param $uniqueId string
     * @param $method integer
     * @return array|null|HLogTemplate
     */
    public function getHLogTemplate($uniqueId, $method)
    {
        return HLogTemplate::find()
            ->where(['unique_id' => $uniqueId, 'status' => HLogTemplate::STATUS_ACTIVE, 'method' => $method])
            ->one();
    }


    /**
     * @param HLogTemplate $hLogTemplate
     * @throws Exception
     */
    public function update(HLogTemplate $hLogTemplate)
    {
        $model = new HLog();
        $user = \Yii::$app->user->identity;
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $template = str_replace('{h-log-request-url}', Yii::$app->request->url, $hLogTemplate->template);

            if ($hLogTemplate->method != HLogTemplate::METHOD_VIEW) {
                preg_match_all('/\{(.*?)\}/', $template, $match);
                if (isset($match[0]) && is_array($match[0])) {
                    $owner = $this->owner;
                    foreach ($match[0] as $key => $value) {
                        $template = str_replace($value, $owner->{$match[1][$key]}, $template);
                    }
                }
            }

            $model->setAttributes([
                'h_log_template_id' => $hLogTemplate->id,
                'user_id' => $user->getId(),
                'username' => isset($user->username) ? $user->username : '',
                'log' => $template,
                'created_at' => time(),
            ]);
            if (!$model->save()) {
                throw new Exception(array_values($model->getFirstErrors())[0]);
            }
            $transaction->commit();
        } catch (Exception $e) {
            Yii::error($e, '[yiier\humansLog][记录日志失败]');
            $transaction->rollBack();
        }
    }
}