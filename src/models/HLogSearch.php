<?php

namespace yiier\humansLog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HLogSearch represents the model behind the search form about `yiier\humansLog\models\HLog`.
 */
class HLogSearch extends HLog
{
    public $createTimeStart;
    public $createTimeEnd;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['h_log_template_id', 'user_id', 'created_at'], 'integer'],
            [['username', 'fk'], 'safe'],
            [['createTimeStart', 'createTimeEnd'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = HLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'h_log_template_id' => $this->h_log_template_id,
            'user_id' => $this->user_id,
            'username' => $this->username,
            'fk' => $this->fk,
        ]);

        if (!empty($params['HLogSearch']['createTimeStart']) || !empty($params['HLogSearch']['createTimeEnd'])) {
            $query->andFilterWhere(['>=', 'created_at', self::beginTimestamp($this->createTimeStart, 0)])
                ->andFilterWhere(['<=', 'created_at', self::endTimestamp($this->createTimeEnd, time())]);
        }


        return $dataProvider;
    }


    /**
     * 获取某天/当前天 最开始的时间戳
     * @param string $time 时间戳 或者 2016-7-25 11:02:21
     * @param $default
     * @return int
     */
    public static function beginTimestamp($time = '', $default = 0)
    {
        $time = ($time) ?: $default;
        $time = is_numeric($time) ? $time : strtotime($time);
        return strtotime(date('Y-m-d', $time));
    }

    /**
     * 获取某天/当前天 结束的时间戳 23:59:59
     * @param string $time 时间戳 或者 2016-7-25 11:02:21
     * @param $default
     * @return int
     */
    public static function endTimestamp($time = '', $default = 0)
    {
        return self::beginTimestamp($time, $default) + 24 * 3600 - 1;
    }
}
