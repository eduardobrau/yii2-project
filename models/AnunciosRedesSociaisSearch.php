<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnunciosRedesSociais;

/**
 * AnunciosRedesSociaisSearch represents the model behind the search form about `app\models\AnunciosRedesSociais`.
 */
class AnunciosRedesSociaisSearch extends AnunciosRedesSociais
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'anuncio_id', 'rede_social_id'], 'integer'],
            [['url'], 'safe'],
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
        $query = AnunciosRedesSociais::find();

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
            'anuncio_id' => $this->anuncio_id,
            'rede_social_id' => $this->rede_social_id,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
