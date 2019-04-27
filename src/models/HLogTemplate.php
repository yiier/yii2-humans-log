<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 17/12/06 15:16
 * description:
 */

namespace yiier\humansLog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yiier\humansLog\HLogBehavior;

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
    const STATUS_DELETE = 0;


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
                'message' => 'unique_id 已经存在'
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
            self::METHOD_INSERT => '添加新数据',
            self::METHOD_VIEW => '查看某条链接',
            self::METHOD_UPDATE => '更新某条数据',
            self::METHOD_DELETE => '删除某条数据',
        ];
    }

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => '启用',
            self::STATUS_DELETE => '停用',
        ];
    }
}