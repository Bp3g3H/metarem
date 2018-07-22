<?php

namespace app\controllers;

use Yii;
use app\models\OrderList;
use app\models\OrderListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderListController implements the CRUD actions for OrderList model.
 */
class OrderListController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OrderList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderList model.
     * @param integer $order_id
     * @param integer $product_id
     * @return mixed
     */
    public function actionView($order_id, $product_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($order_id, $product_id),
        ]);
    }

    /**
     * Creates a new OrderList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'order_id' => $model->order_id, 'product_id' => $model->product_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OrderList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $order_id
     * @param integer $product_id
     * @return mixed
     */
    public function actionUpdate($order_id, $product_id)
    {
        $model = $this->findModel($order_id, $product_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'order_id' => $model->order_id, 'product_id' => $model->product_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrderList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $order_id
     * @param integer $product_id
     * @return mixed
     */
    public function actionDelete($order_id, $product_id)
    {
        $this->findModel($order_id, $product_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $order_id
     * @param integer $product_id
     * @return OrderList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($order_id, $product_id)
    {
        if (($model = OrderList::findOne(['order_id' => $order_id, 'product_id' => $product_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
