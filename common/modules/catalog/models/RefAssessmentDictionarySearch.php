<?php

namespace common\modules\catalog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\catalog\models\RefAssessmentDictionary;

/**
 * RefAssessmentDictionarySearch represents the model behind the search form about `common\modules\catalog\models\RefAssessmentDictionary`.
 */
class RefAssessmentDictionarySearch extends RefAssessmentDictionary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'key', 'value', 'textvalue', 'attribute_1', 'attribute_2', 'attribute_3'], 'safe'],
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
        $query = RefAssessmentDictionary::find();

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
        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'textvalue', $this->textvalue])
            ->andFilterWhere(['like', 'attribute_1', $this->attribute_1])
            ->andFilterWhere(['like', 'attribute_2', $this->attribute_2])
            ->andFilterWhere(['like', 'attribute_3', $this->attribute_3]);

        return $dataProvider;
    }
}
