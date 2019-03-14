<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property string $name
 * @property int $inn
 * @property string $director
 * @property string $adress
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'inn', 'director', 'adress'], 'required'],
            [['inn'], 'integer'],
            [['adress'], 'string'],
            [['name', 'director'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'inn' => 'ИНН',
            'director' => 'Директор',
            'adress' => 'Адрес',
        ];
    }
}
