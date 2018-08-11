<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.7.2018 г.
 * Time: 20:55 ч.
 */

namespace app\models;


use app\models\base\ProductBase;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class Product extends ProductBase
{
    public $services_checkbox;

    const LASER_CUTTING = 0;
    const ENGRAVING = 1;
    const PUNCHING = 2;
    const BENDING = 3;

    const LASER_CUTTING_ABV = 'LC';
    const ENGRAVING_ABV = 'ENG';
    const PUNCHING_ABV = 'PUN';
    const BENDING_ABV = 'BEN';

    const LASER_CUTTING_STRING = 'Лазерно рязане';
    const ENGRAVING_STRING = 'Гравиране';
    const PUNCHING_STRING = 'Щанцоване';
    const BENDING_STRING = 'Огъване';


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

    public function afterFind()
    {
        $this->services = json_decode($this->services, true);
        $this->getCheckedServices();
        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        $this->price = null;

        foreach ($this->services as $service)
        {
            if($this->price)
                $this->price += $service;
            else
                $this->price = $service;
        }

        $this->services = json_encode($this->services);

        $this->price_for_cutting = $this->price * $this->quantity;
        $this->full_weight = $this->weight * $this->quantity;
        $this->single_price_with_material = $this->price + ($this->weight * $this->material->price);
        $this->full_price = $this->single_price_with_material * $this->quantity;
        $this->price_with_dds = $this->full_price * 1.2;

        return parent::beforeSave($insert);
    }

    public static function getServices()
    {
        return [
            self::LASER_CUTTING => self::LASER_CUTTING_STRING,
            self::ENGRAVING => self::ENGRAVING_STRING,
            self::PUNCHING => self::PUNCHING_STRING,
            self::BENDING => self::BENDING_STRING,
        ];
    }

    public function getCheckedServices()
    {
        if($this->services){
            foreach ($this->services as $service => $cost)
            {
                switch ($service)
                {
                    case self::LASER_CUTTING_ABV:
                        $this->services_checkbox[] = self::LASER_CUTTING;
                        break;
                    case self::ENGRAVING_ABV:
                        $this->services_checkbox[] = self::ENGRAVING;
                        break;
                    case self::PUNCHING_ABV:
                        $this->services_checkbox[] = self::PUNCHING;
                        break;
                    case self::BENDING_ABV:
                        $this->services_checkbox[] = self::BENDING;
                        break;
                }
            }
        }
    }

    public function displayServices()
    {
        $services = [];
        if($this->services && is_array($this->services))
        {
            foreach (array_keys($this->services) as $abv)
            {
                switch ($abv)
                {
                    case self::LASER_CUTTING_ABV:
                        $services[] = self::LASER_CUTTING_STRING;
                        break;
                    case self::ENGRAVING_ABV:
                        $services[] = self::ENGRAVING_STRING;
                        break;
                    case self::PUNCHING_ABV:
                        $services[] = self::PUNCHING_STRING;
                        break;
                    case self::BENDING_ABV:
                        $services[] = self::BENDING_STRING;
                        break;
                }
            }
        }

        return implode(',<br>' , $services);
    }
}