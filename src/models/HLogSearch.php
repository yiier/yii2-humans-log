<?php

namespace yiier\humansLog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yiier\humansLog\models\HLog;

/**
 * HLogSearch represents the model behind the search form about `yiier\humansLog\models\HLog`.
 */
class HLogSearch extends HLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'h_log_template_id', 'user_id', 'created_at'], 'integer'],
            [['username', 'log'], 'safe'],
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
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'h_log_template_id' => $this->h_log_template_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'log', $this->log]);

        return $dataProvider;
    }
}
