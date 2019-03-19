<?php

namespace app\controllers;

use app\models\admin\CompaniesHistorySearch;
use app\models\Utils;
use Yii;
use app\models\Companies;
use app\models\CompaniesSearch;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompaniesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete', 'moderate'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->getUser()->identity->role === 'editor';
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete', 'moderate'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->getUser()->identity->role === 'admin';
                        }
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $sort = new Sort([
            'attributes' => [
                'name' => [
                    'desc' => [$searchModel::tableName() . '.name' => SORT_DESC],
                    'asc' => [$searchModel::tableName() . '.name' => SORT_ASC],
                    'default' => SORT_ASC,
                    'label' => 'Название'
                ],
                'inn' => [
                    'desc' => [$searchModel::tableName() . '.inn' => SORT_DESC],
                    'asc' => [$searchModel::tableName() . '.inn' => SORT_ASC],
                    'label' => 'ИНН'
                ],
            ],
        ]);
        $dataProvider->query->orderBy($sort->orders);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sort' => $sort,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $historyModel = $model->getCompaniesHistories();
        $dataProvider = new ActiveDataProvider([
            'query' => $historyModel,
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Companies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Companies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $historyModel = $model->getHistoryToUpdate($id);
        try {
            if ($historyModel !== null) {
                if ($historyModel !== false) {
                    return $this->redirect(['view', 'id' => $id]);
                }
            }
        } catch (StaleObjectException $e) {
            Utils::debug($e);
        }
        $historyModel = $this->findModel($id);
        return $this->render('update', [
            'model' => $historyModel
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionModerate($id) {
        $model = $this->findModel($id);
        $model->moderate($id);
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Deletes an existing Companies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companies::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
