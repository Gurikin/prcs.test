<?php

namespace app\models;

use app\models\admin\CompaniesHistory;
use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property string $name
 * @property int $inn
 * @property string $director
 * @property string $adress
 * @property int $status
 *
 * @property CompaniesHistory[] $companiesHistories
 */
class Companies extends \yii\db\ActiveRecord
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
            [['inn', 'status'], 'integer'],
            [['adress'], 'string'],
            [['name', 'director'], 'string', 'max' => 255],
            [['inn'], 'unique'],
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
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompaniesHistories()
    {
        return $this->hasMany(CompaniesHistory::className(), ['company_id' => 'id']);
    }

    /**
     * @param $id
     * @return CompaniesHistory|null
     */
    public function getHistoryToUpdate($id)
    {
        $model = new CompaniesHistory();
        $model->loadDefaultValues();
        $post = Yii::$app->request->post();
        if (isset($post['Companies'])) {
            if (!$model->load($post)) {
                $this->status = 1;
                $model->name = $post['Companies']['name'];
                $model->company_id = $id;
                $model->inn = $post['Companies']['inn'];
                $model->director = $post['Companies']['director'];
                $model->adress = $post['Companies']['adress'];
                if ($model->save() === false or $this->save() === false) {
                    return NULL;
                }
                return $model;
            }
        }
        return NULL;
    }

    public function moderate($id)
    {
        $historyModel = $this->getCompaniesHistories()->where(['status' => 1])->orderBy('last_change DESC')->limit(1)->one();
        $this->name = $historyModel->name;
        $this->inn = $historyModel->inn;
        $this->director = $historyModel->director;
        $this->adress = $historyModel->adress;
        $this->status = 2;
            $historyModel->status = 4;
            $newHistoryModel = new CompaniesHistory();
            $newHistoryModel->loadDefaultValues();
            $newHistoryModel->setAttributes([
                'name' => $historyModel->name,
                'inn' => $historyModel->inn,
                'company_id' => $id,
                'director' => $historyModel->director,
                'adress' => $historyModel->adress,
                'status' => 2]);
            if ($newHistoryModel->save() === false || $historyModel->save() === false || $this->save() === false) {
                return NULL;
            }
        return true;
    }
}
