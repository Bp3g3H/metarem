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
    public $firm_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'firm_id', 'quantity'], 'integer'],
            [['product_name', 'material_id', 'created_at', 'updated_at', 'firm_name'], 'safe'],
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
        $query = Product::find()->joinWith(['firm', 'material']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['firm_name'] = [
            'asc' => ['firm.name' => SORT_ASC],
            'desc' => ['firm.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['material_name'] = [
            'asc' => ['material.name' => SORT_ASC],
            'desc' => ['material.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'firm_id' => $this->firm_id,
            'quantity' => $this->quantity,
            'material_id' => $this->material_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'material.name', $this->product_name]);

        return $dataProvider;
    }
}
