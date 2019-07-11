<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Body".
 *
 * @property int $id
 * @property int $car_id
 * @property int $hp
 *
 * @property Car $car
 */
class Body extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Body';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id'], 'required'],
            [['car_id', 'hp'], 'default', 'value' => null],
            [['car_id', 'hp'], 'integer'],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Car ID',
            'hp' => 'Hp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }
    public function getHP(){
        return $this->hp;
    }
}
