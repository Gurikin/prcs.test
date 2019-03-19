<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $status_name
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    private static $_items = array();

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['status_name'], 'string', 'max' => 255],
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
            'status_name' => 'Статус',
        ];
    }

    public static function items()
    {
        if(!isset(self::$_items))
            self::loadItems();
        return self::$_items;
    }

    public static function item($id)
    {
        if (!isset(self::$_items[$id]))
            self::loadItems();
        return isset(self::$_items[$id]) ? self::$_items[$id] : false;
    }

    /**
     *
     */
    private static function loadItems()
    {
        self::$_items = array();
        $models = self::find()->all();
        foreach ($models as $model)
            self::$_items[$model->id] = $model->status_name;
    }
}
