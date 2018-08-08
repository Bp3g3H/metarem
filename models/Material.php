<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/24/2018
 * Time: 10:04 PM
 */

namespace app\models;


use app\models\base\MaterialBase;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class Material extends MaterialBase
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

    public static function getMaterialsForDropdown()
    {
        $material = self::find()->all();
        return ArrayHelper::map($material, 'id', 'name');
    }
}