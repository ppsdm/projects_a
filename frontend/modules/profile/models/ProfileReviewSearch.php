<?php

namespace app\modules\profile\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\profile\models\ProfileReview;

/**
 * ProfileReviewSearch represents the model behind the search form about `app\modules\profile\models\ProfileReview`.
 */
class ProfileReviewSearch extends ProfileReview
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reviewer_id', 'reviewee_id'], 'integer'],
            [['review', 'attribute_1', 'attribute_2', 'attribute_3', 'created_at', 'modified_at'], 'safe'],
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
        $query = ProfileReview::find();

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
            'reviewer_id' => $this->reviewer_id,
            'reviewee_id' => $this->reviewee_id,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'review', $this->review])
            ->andFilterWhere(['like', 'attribute_1', $this->attribute_1])
            ->andFilterWhere(['like', 'attribute_2', $this->attribute_2])
            ->andFilterWhere(['like', 'attribute_3', $this->attribute_3]);

        return $dataProvider;
    }
}
