<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cleaner;

/**
 * CleanerSearch represents the model behind the search form about `common\models\Cleaner`.
 */
class CleanerSearch extends Cleaner
{
    public $category;
    public $region; 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
              [['category', 'region'], 'safe'],
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
        $query = Cleaner::find();
            $query->joinWith(['cleanerCategories as cc','cleanerRegions as cr']);

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
            'user_id' => $this->user_id,
        ]);
           $query->andFilterWhere(['=', 'cc.category_id', $this->category])
           ->andFilterWhere(['=', 'cr.region_id', $this->region]);
        return $dataProvider;
    }
}
