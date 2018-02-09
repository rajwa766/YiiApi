<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Advertisment;

/**
 * AdvertismentSearch represents the model behind the search form about `common\models\Advertisment`.
 */
class AdvertismentSearch extends Advertisment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'login_user_id', 'pool_id'], 'integer'],
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
        $query = Advertisment::find();

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
            'pool_id' => $this->pool_id,
            'login_user_id' => $this->login_user_id,
        ]);

        return $dataProvider;
    }
}
