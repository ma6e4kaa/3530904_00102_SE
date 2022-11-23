<?php

namespace app\controllers;

use app\models\Tour;
use app\models\TourSearch;
use app\models\TourDateSearch;
use app\models\TourStationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TourController implements the CRUD actions for Tour model.
 */
class TourController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Tour models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TourSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tour model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchDateModel = new TourDateSearch();
        $dataDateProvider = $searchDateModel->search($id, $this->request->queryParams);
        
        $searchStationModel = new TourStationSearch();
        $dataStationProvider = $searchStationModel->search($id, $this->request->queryParams);
        
        $searchFeedbackModel = new \app\models\FeedbackSearch();
        $dataFeedbackProvider = $searchFeedbackModel->searchInTour($id, $this->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchDateModel' => $searchDateModel,
            'dataDateProvider' => $dataDateProvider,
            'searchStationModel' => $searchStationModel,
            'dataStationProvider' => $dataStationProvider,
            'searchFeedbackModel' => $searchFeedbackModel,
            'dataFeedbackProvider' => $dataFeedbackProvider,
        ]);
    }
    
    public function actionViewDate($id)
    {
        return $this->render('view-date', [
            'model' => $this->findDateModel($id),
        ]);
    }
    
    public function actionViewStation($id)
    {
        return $this->render('view-station', [
            'model' => $this->findStationModel($id),
        ]);
    }

    /**
     * Creates a new Tour model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tour();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionCreateDate($id)
    {
        $model = new \app\models\TourDate();
        $model->tour_id = $id;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-date', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create-date', [
            'model' => $model,
        ]);
    }
    
    public function actionCreateStation($id)
    {
        $model = new \app\models\TourStation();
        $model->tour_id = $id;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-station', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create-station', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tour model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdateDate($id)
    {
        $model = $this->findDateModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-date', 'id' => $model->id]);
        }

        return $this->render('update-date', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdateStation($id)
    {
        $model = $this->findStationModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-station', 'id' => $model->id]);
        }

        return $this->render('update-station', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tour model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionDeleteDate($id)
    {
        $this->findDateModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionDeleteStation($id)
    {
        $this->findStationModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tour::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    protected function findDateModel($id)
    {
        if (($model = \app\models\TourDate::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    protected function findStationModel($id)
    {
        if (($model = \app\models\TourStation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
