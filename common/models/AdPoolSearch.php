<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AdPool;

/**
 * AdPoolSearch represents the model behind the search form about `common\models\AdPool`.
 */
class AdPoolSearch extends AdPool
{
   
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['cleaner_user_id','ad_place_id','subscription_id','status','image'],'safe'],
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
        $query = AdPool::find()->alias('a')->joinwith(['poolUser','adPlace as p','subscription']);

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
            //'cleaner_user_id' => $this->cleaner_user_id,
           // 'ad_place_id' => $this->ad_place_id,
           //'subscription_id' => $this->subscription_id,
        ]);
        $query->andFilterWhere(['like','p.name',$this->ad_place_id])
              ->andFilterWhere(['like','username',$this->cleaner_user_id])
              ->andFilterWhere(['like','subscription.name',$this->subscription_id])
              ->andFilterWhere(['like', 'image', $this->image])
              ->andFilterWhere(['like', 'a.status',$this->status]);
       // $query->andFilterWhere(['like','subscription.name',$this->subscription_id]);
        return $dataProvider;
    }
}
