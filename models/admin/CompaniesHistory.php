<?php

namespace app\models\admin;

use app\models\Companies;
use Yii;

/**
 * This is the model class for table "companies_history".
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property int $inn
 * @property string $director
 * @property string $adress
 * @property int $status
 * @property string $last_change
 *
 * @property Companies $company
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
            [['company_id', 'name', 'inn', 'director', 'adress'], 'required'],
            [['company_id', 'inn', 'status'], 'integer'],
            [['adress'], 'string'],
            [['last_change'], 'safe'],
            [['name', 'director'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'inn' => 'Inn',
            'director' => 'Director',
            'adress' => 'Adress',
            'status' => 'Status',
            'last_change' => 'Last Change',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'company_id']);
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function deniedChange() {
        $company = $this->getCompany()->one();
        $company->status = 0;
        $this->status = 0;
        if ($this->save() === false || $company->save() === false) {
            return false;
        }
        return true;
    }
}
