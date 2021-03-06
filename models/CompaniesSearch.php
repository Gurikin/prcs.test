<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Companies;
use yii\data\Sort;

/**
 * CompanySearch represents the model behind the search form of `app\models\Company`.
 */
class CompaniesSearch extends Companies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inn', 'status'], 'integer'],
            [['name', 'director', 'adress'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Companies::find()->where('status < :status',['status'=>3]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'adress', $this->adress]);

        return $dataProvider;
    }
}
