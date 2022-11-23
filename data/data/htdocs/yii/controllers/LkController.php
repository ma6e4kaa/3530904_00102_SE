<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LkController implements the CRUD actions for User model.
 */
class LkController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex($id)
    {
        $model = (new \app\models\UserAttr)->find()->where(['user_id' => $id])->one();
        if (!$model) {
            $model = new \app\models\UserAttr;
            $model->user_id = $id;
        }
        $user = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_model = $this->findModel($id);
        $message = null;
        $model->password = '';
        if ($this->request->isPost && $model->load($this->request->post())) {
            if (\Yii::$app->getSecurity()->validatePassword($_POST['User']['old_passwd'], $old_model->password)) {
                $model->password = \Yii::$app->getSecurity()->generatePasswordHash($model->password);
                if ($model->save()) {
                    return $this->redirect(['index', 'id' => $model->id]);
                }
            } else {
                $message = 'Неправильный пароль!';
            }
        }

        return $this->render('update_pass', [
            'model' => $model,
            'message' => $message,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}