<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 17/12/06 15:16
 * description:
 */

namespace yiier\humansLog\models;

use Yii;

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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'unique_id', 'template'], 'required'],
            [['method', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'unique_id'], 'string', 'max' => 32],
            [['template'], 'string', 'max' => 255],
            [['unique_id', 'method'], 'unique', 'targetAttribute' => ['unique_id', 'method'], 'message' => 'unique_id 已经存在'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '标题'),
            'unique_id' => Yii::t('app', '唯一标识 action uniqueId 或者 model class'),
            'template' => Yii::t('app', '模板'),
            'method' => Yii::t('app', '请求方式 1 insert 2 view 3 update 4 delete'),
            'status' => Yii::t('app', '状态 0暂停 1开启'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}