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
    const DENIED = 0;
    const PENDING_APPROVAL = 1;
    const COMPLETED = 2;
    const CREATED = 3;
    const DELETED = 4;
    const ARCHIVED = 5;

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
     * @return CompaniesHistory|bool|null
     */
    public function createCompany()
    {
        $post = Yii::$app->request->post();
        $this->setAttribute('status', self::CREATED);
        if ($this->load($post) && $this->save()) {
            $historyModel = new CompaniesHistory();
            $maxId = self::find()->max('id');
            $historyModel->setAttributes([
                'company_id'    => $maxId,
                'status'        => self::CREATED,
                'name'          => $post['Companies']['name'],
                'inn'           => $post['Companies']['inn'],
                'director'      => $post['Companies']['director'],
                'adress'        => $post['Companies']['adress'],
            ]);
            if ($historyModel->save()) {
                return $historyModel;
            }
            return NULL;
        }
        return false;
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
                $this->setAttribute('status', self::PENDING_APPROVAL);
                $model->setAttributes([
                    'name' => $post['Companies']['name'],
                    'company_id' => $id,
                    'inn' => $post['Companies']['inn'],
                    'director' => $post['Companies']['director'],
                    'adress' => $post['Companies']['adress']
                ]);
                if ($model->save() === false or $this->save() === false) {
                    return NULL;
                }
                return $model;
            }
        }
        return NULL;
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function moderate($id)
    {
        $historyModel = $this->getCompaniesHistories()->where('status = :pending_approval or status = :created', ['pending_approval' => self::PENDING_APPROVAL, 'created' => self::CREATED])->orderBy('last_change DESC')->limit(1)->one();
        $this->setAttributes([
            'name' => $historyModel->name,
            'inn' => $historyModel->inn,
            'director' => $historyModel->director,
            'adress' => $historyModel->adress,
            'status' => self::COMPLETED,
        ]);
        $historyModel->setAttribute('status', self::ARCHIVED);
        $newHistoryModel = new CompaniesHistory();
        $newHistoryModel->loadDefaultValues();
        $newHistoryModel->setAttributes([
            'name' => $historyModel->name,
            'inn' => $historyModel->inn,
            'company_id' => $id,
            'director' => $historyModel->director,
            'adress' => $historyModel->adress,
            'status' => self::COMPLETED]);
        if ($newHistoryModel->save() === false || $historyModel->save() === false || $this->save() === false) {
            return NULL;
        }
        return true;
    }
}
