<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.7.2018 г.
 * Time: 20:53 ч.
 */

namespace app\models;


use app\models\base\FirmBase;
use yii\behaviors\TimestampBehavior;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class Firm extends FirmBase
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),[
            ['name', 'unique', 'message' => 'Фирма с това име вече съществува!']
        ]);
    }

    public static function getFirmsForDropdown()
    {
        $firms = self::find()->all();
        return ArrayHelper::map($firms, 'id', 'name');
    }
}