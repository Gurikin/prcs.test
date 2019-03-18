<?php

namespace app\models;

use app\models\admin\CompaniesHistory;
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

    public static function primaryKey()
    {
        return ["inn"];
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
            'name' => 'Название',
            'inn' => 'ИНН',
            'director' => 'Директор',
            'adress' => 'Адрес',
        ];
    }

    public function getHistoryToUpdate()
    {
//        if ($model = CompaniesHistory::find()->where(['inn'=>$company['Company']['inn']])) {
//            return $model->one();
//        }


            $model = new CompaniesHistory();
            $post = Yii::$app->request->post();
            try {
                $model->load($post);
                $model->save();
//                $model = CompaniesHistory::find()->where(['inn' => $post['Company']['inn']]);
//                return $model->one();
            } catch (\Exception $exception) {
                return [false,$exception];
            }




//            $model->name = $company['Company']['name'];
//            $model->inn = $company['Company']['inn'];
//            $model->director = $company['Company']['director'];
//            $model->adress = $company['Company']['adress'];
//            if ($model->save() === false) {
//                return false;
//            }
//            $model = CompaniesHistory::find()->where(['inn' => $company['Company']['inn']]);
//            return $model->one();
//        }
//        return false;
    }
}
