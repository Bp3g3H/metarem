<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/11/2018
 * Time: 6:22 PM
 */

namespace app\models;


use yii\base\Model;
use yii\data\ArrayDataProvider;

class StatsForm extends Model
{
    public $search_from;
    public $search_to;
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'search_from', 'search_to'], 'safe'],
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

    public function search($params)
    {
        $query = Material::find()->select([
            'material.*',
            'SUM(product.full_weight) as used_weight'
        ])->joinWith(['products'])->groupBy('material.id')->asArray();

        $this->load($params);

        // add conditions that should always apply here
        $query->andFilterWhere(['like', 'material.name', $this->name]);

        if($this->search_from || $this->search_to){
            if(!$this->search_from)
            {
                $query->andFilterWhere(['between', 'product.created_at', date('Y-m-d 00:00:00', strtotime(null)), date_create_from_format('d/m/Y', $this->search_to)->format('Y-m-d 23:59:59')]);
            }
            elseif (!$this->search_to)
            {
                $query->andFilterWhere(['between', 'product.created_at', date_create_from_format('d/m/Y', $this->search_from)->format('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')]);
            }
            else
            {
                $query->andFilterWhere(['between', 'product.created_at', date_create_from_format('d/m/Y', $this->search_from)->format('Y-m-d 00:00:00'), date_create_from_format('d/m/Y', $this->search_to)->format('Y-m-d 23:59:59')]);
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query->all(),
        ]);

        return $dataProvider;
    }
}