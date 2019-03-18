<?php

namespace app\models\admin;

use Yii;

/**
 * This is the model class for table "companies_history".
 *
 * @property int $id
 * @property string $name
 * @property int $inn
 * @property string $director
 * @property string $adress
 * @property int $status
 * @property string $last_change
 */
class CompaniesHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'inn', 'director', 'adress', 'status', 'last_change'], 'required'],
            [['id', 'inn', 'status'], 'integer'],
            [['adress'], 'string'],
            [['last_change'], 'safe'],
            [['name', 'director'], 'string', 'max' => 255],
            [['id'], 'unique'],
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
            'status' => 'Статус',
            'last_change' => 'Когда изменено',
        ];
    }
}
