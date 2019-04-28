<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 17/12/06 15:16
 * description:
 */

namespace yiier\humansLog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yiier\helpers\ArrayHelper;
use yiier\humansLog\HLogBehavior;
use yiier\humansLog\Module;

/**
 * This is the model class for table "{{%h_log_template}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $unique_id
 * @property string $template
 * @property integer $method
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class HLogTemplate extends \yii\db\ActiveRecord
{

    /**
     * @var integer
     */
    const STATUS_ACTIVE = 1;

    /**
     * @var integer
     */
    const STATUS_STOP = 0;


    /**
     * @var integer
     */
    const METHOD_INSERT = 1;

    /**
     * @var integer
     */
    const METHOD_VIEW = 2;

    /**
     * @var integer
     */
    const METHOD_UPDATE = 3;

    /**
     * @var integer
     */
    const METHOD_DELETE = 4;

    /**
     * @var integer
     */
    const METHOD_OTHER = 5;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%h_log_template}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            HLogBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'unique_id', 'template'], 'required'],
            [['method', 'status', 'created_at', 'updated_at'], 'integer'],
            [['template', 'title', 'unique_id'], 'string', 'max' => 255],
            [
                ['unique_id', 'method'],
                'unique',
                'targetAttribute' => ['unique_id', 'method'],
                'message' => Yii::t('hlog', 'Unique ID And Method Existed')
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('hlog', 'ID'),
            'title' => Yii::t('hlog', 'Title'),
            'unique_id' => Yii::t('hlog', 'Unique ID'),
            'template' => Yii::t('hlog', 'Template'),
            'method' => Yii::t('hlog', 'Method'),
            'status' => Yii::t('hlog', 'Status'),
            'created_at' => Yii::t('hlog', 'Created At'),
            'updated_at' => Yii::t('hlog', 'Updated At'),
        ];
    }


    /**
     * @return array
     */
    public static function getMethods()
    {
        return [
            self::METHOD_INSERT => Yii::t('hlog', 'Method Insert'),
            self::METHOD_VIEW => Yii::t('hlog', 'Method View'),
            self::METHOD_UPDATE => Yii::t('hlog', 'Method Update'),
            self::METHOD_DELETE => Yii::t('hlog', 'Method Delete'),
            self::METHOD_OTHER => Yii::t('hlog', 'Method Other'),
        ];
    }

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('hlog', 'Active'),
            self::STATUS_STOP => Yii::t('hlog', 'Stop'),
        ];
    }


    /**
     * @return bool
     * @throws \Exception
     */
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if (Module::getInstance()->safeDelete && HLog::find()->where(['h_log_template_id' => $this->id])->exists()) {
                throw new \Exception(Yii::t('hlog', 'Already have log data, can\'t delete.'));
            }
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    public static function getIdAndTitleMap()
    {
        return ArrayHelper::map(
            self::find()->where(['status' => self::STATUS_ACTIVE])->asArray()->all(),
            'id',
            'title'
        );
    }
}