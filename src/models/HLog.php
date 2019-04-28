<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 17/12/06 15:16
 * description:
 */

namespace yiier\humansLog\models;

use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "{{%h_log}}".
 *
 * @property integer $id
 * @property integer $h_log_template_id
 * @property integer $user_id
 * @property string $username
 * @property string $log
 * @property integer $created_at
 */
class HLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%h_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['h_log_template_id', 'user_id', 'created_at'], 'integer'],
            [['user_id', 'log'], 'required'],
            [['username'], 'string', 'max' => 50],
            [['log'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('hlog', 'ID'),
            'h_log_template_id' => Yii::t('hlog', 'Log Template ID'),
            'user_id' => Yii::t('hlog', 'User ID'),
            'username' => Yii::t('hlog', 'Username'),
            'log' => Yii::t('hlog', 'Log'),
            'created_at' => Yii::t('hlog', 'Created At'),
        ];
    }

    /**
     * 单独记录日志的情况
     * @param $template string 日志
     * @param null $id
     * @return bool
     */
    public static function saveLog($template, $id = null)
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        $model = new self();
        $user = \Yii::$app->user->identity;
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $templateId = $id && HLogTemplate::find()->where(['id' => $id])->exists() ? $id : '';
            $model->setAttributes([
                'user_id' => $user->getId(),
                'h_log_template_id' => $templateId,
                'username' => isset($user->username) ? $user->username : '',
                'log' => $template,
                'created_at' => time(),
            ]);
            if (!$model->save()) {
                throw new Exception(array_values($model->getFirstErrors())[0]);
            }
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            Yii::error($e, '[yiier\humansLog][fail]');
            $transaction->rollBack();
        }
    }
}