<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Car".
 *
 * @property int $id
 * @property string $name
 * @property int $race_count
 *
 * @property Body[] $bodies
 * @property Engine[] $engines
 * @property Transmission[] $transmissions
 * @property Wheel[] $wheels
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['race_count'], 'default', 'value' => null],
            [['race_count'], 'integer'],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'race_count' => 'Race Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBodies()
    {
        return $this->hasOne(Body::className(), ['car_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngines()
    {
        return $this->hasOne(Engine::className(), ['car_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransmissions()
    {
        return $this->hasOne(Transmission::className(), ['car_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWheels()
    {
        return $this->hasMany(Wheel::className(), ['car_id' => 'id']);
    }
}
