<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bairros;

/**
 * BairrosSearch represents the model behind the search form about `app\models\Bairros`.
 */
class BairrosSearch extends Bairros
{
    public $cidade;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cidade_id'], 'integer'],
            [['bairro', 'cep', 'cidade'], 'safe'],
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
        $query = Bairros::find();

        $query->joinWith(['cidade']);

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
            'cidade_id' => $this->cidade_id,
        ]);

        $query->andFilterWhere(['like', 'bairro', $this->bairro])
            ->andFilterWhere(['like', 'cep', $this->cep]);
        
        $query->andFilterWhere(['like', 'cidade.cidade', $this->cidade]);

        return $dataProvider;
    }
}
