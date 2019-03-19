<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\CompaniesHistory;
use app\models\admin\CompaniesHistorySearch;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompaniesHistoryController implements the CRUD actions for CompaniesHistory model.
 */
class CompaniesHistoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['editor-index', 'admin-index', 'view', 'create', 'update', 'delete', 'moderate', 'denied-changes'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['editor-index', 'view', 'create', 'update'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->getUser()->identity->role === 'editor';
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['admin-index', 'view', 'delete', 'denied-changes'],
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
     * Lists all CompaniesHistory models.
     * @return mixed
     */
    public function actionEditorIndex()
    {
        $searchModel = new CompaniesHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all CompaniesHistory models.
     * @return mixed
     */
    public function actionAdminIndex()
    {
        $searchModel = new CompaniesHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompaniesHistory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CompaniesHistory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompaniesHistory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CompaniesHistory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CompaniesHistory model.
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

    public function actionDeniedChanges($id) {
        $model = $this->findModel($id);
        $model->deniedChange();
        return $this->redirect(['../../companies/view','id'=>$model->company_id]);
    }

    /**
     * Finds the CompaniesHistory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompaniesHistory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompaniesHistory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
