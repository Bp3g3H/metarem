<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'firm_id', 'quantity'], 'integer'],
            [['product_name', 'material', 'created_at', 'updated_at'], 'safe'],
            [['price', 'weight', 'price_for_cutting', 'full_weight', 'single_price_with_material', 'full_price', 'price_with_dds'], 'number'],
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
        $query = Product::find();

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
            'firm_id' => $this->firm_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'weight' => $this->weight,
            'price_for_cutting' => $this->price_for_cutting,
            'full_weight' => $this->full_weight,
            'single_price_with_material' => $this->single_price_with_material,
            'full_price' => $this->full_price,
            'price_with_dds' => $this->price_with_dds,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'material', $this->material]);

        return $dataProvider;
    }
}
