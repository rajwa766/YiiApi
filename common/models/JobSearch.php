<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Job;

/**
 * JobSearch represents the model behind the search form about `common\models\Job`.
 */
class JobSearch extends Job
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status','work_options'], 'integer'],
            [['title', 'contact_no','region_id','customer_user_id','category_id' ,'description', 'address', 'timestamp', 'date'], 'safe'],
            [['price', 'longitude', 'latitude'], 'number'],
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
        $query = Job::find()->joinWith('region')->joinWith('user')->joinWith('category');

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
            'price' => $this->price,
            'job.status' => $this->status,
            'timestamp' => $this->timestamp,
            'date' => $this->date,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'work_options'=>$this->work_options,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like','region.name', $this->region_id])
            ->andFilterWhere(['like','user.username', $this->customer_user_id])
            ->andFilterWhere(['like','category.name', $this->category_id])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'address', $this->address]);
        

        return $dataProvider;
    }
}
