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
    public $email;
    public $region_name;
    public $category_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_user_id', 'category_id', 'region_id', 'status'], 'integer'],
            [['longitude','latitude'],'double'],
            [['title','description','region_name',  'category_name', 'category_id','contact_no', 'address', 'timestamp','email'], 'safe'],
            [['price'], 'number'],
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
        $query = Job::find()->alias('j')->joinwith(['user','category','region']);

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
            'j.id' => $this->id,
            'customer_user_id' => $this->customer_user_id,
           // 'region_id' => $this->region_id,
            'category_id' => $this->category_id,
           // 'price' => $this->price,
          // 'contact_no'=>$this->contact_no,
            'status' => $this->status,
             'date' => $this -> date,
             'longitude'=>$this->longitude,
             'latitude'=>$this->latitude,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
             ->andFilterWhere(['like','user.email',$this->email])
             ->andFilterWhere(['like','region.name', $this->region_name])
             ->andFilterWhere(['like','price',$this->price])
             ->andFilterWhere(['like','category.name',$this->category_name])
             ->andFilterWhere(['like','j.contact_no',$this->contact_no])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like','longitude', $this->longitude])
            ->andFilterWhere(['like','latitude',$this->latitude]);

        return $dataProvider;
    }
}
