<?php

namespace app\controllers;

use app\models\Tickets;
use app\models\TicketsSearch;
use app\models\SalesDetailsSearch;
use app\models\SalesDetails;
use app\models\Sales;
use app\models\SalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;

/**
 * TicketsController implements the CRUD actions for Tickets model.
 */
class TicketsController extends Controller
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
     * Lists all Tickets models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TicketsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tickets model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchSalesModel = new SalesDetailsSearch();
        $dataSalesProvider = $searchSalesModel->searchInTour($id, $this->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchSalesModel' => $searchSalesModel,
            'dataSalesProvider' => $dataSalesProvider,
        ]);
    }

    /**
     * Creates a new Tickets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tickets();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $tour_date = \app\models\TourDate::find()->where(['id'=> $model->tour_date_id])->one();
                if ($tour_date->seats < 1) {
                    \Yii::$app->session->setFlash('error', "Мест на тур больше нет!");
                } else {
                    $tour_date->seats--;
                    $tour_date->save();
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionCreateSale($ticket_id)
    {
        $modelSales = new Sales();
        $modelSales->ticket_id = $ticket_id;
        $modelsSalesDetails = [new SalesDetails()];

        if ($modelSales->load($this->request->post())) {
            $modelsSalesDetails = Model::createMultiple(SalesDetails::className());
            Model::loadMultiple($modelsSalesDetails, \Yii::$app->request->post());
            $valid = $modelSales->validate();
            //$valid = Model::validateMultiple($modelsSalesDetails) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelSales->save(false)) {
                        foreach ($modelsSalesDetails as $modelSalesDetails) {
                            $modelSalesDetails->sale_id = $modelSales->id;
//                            проверка кол-ва товаров в наличии
                            $good = \app\models\Goods::find()->where(['id' => $modelSalesDetails->good_id])->one();
                            if ($good->quantity < $modelSalesDetails->quantity) {
                                \Yii::$app->session->setFlash('error', "Кол-во товара в наличии меньше указанного!");
                                $flag = false;
                                $transaction->rollBack();
                                break;
                            }
                            else {
                                $good->quantity -= $modelSalesDetails->quantity;
                                if (!($flag = $good->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                            if (!($flag = $modelSalesDetails->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelSales->ticket_id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create-sale', [
            'modelSales' => $modelSales,
            'modelsSalesDetails' => (empty($modelsSalesDetails)) ? [new modelsSalesDetails()] : $modelsSalesDetails,
        ]);
    }

    public function actionSetDate($id)
    {
        return json_encode(\yii\helpers\ArrayHelper::map(\app\models\TourDate::find()->where(['tour_id' => $id])->orderBy('date_tour')->all(), 'id', function($model) {
            return date('d.m.Y', strtotime($model->date_tour));
        }));
    }

    /**
     * Updates an existing Tickets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->tour_id = $model->tourDate->tour_id;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tickets model.
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
    
    public function actionDeleteSales($id)
    {
        $this->findSalesModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tickets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tickets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tickets::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    protected function findSalesModel($id)
    {
        if (($model = \app\models\SalesDetails::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
