<?php

namespace app\controllers;

use app\models\Firm;
use app\models\Material;
use app\models\Order;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BaseController
{
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()))
        {
            $order = $model->firm->getOrders()->where('status <> :status', [':status' => Order::STATUS_DONE])->one();

            if (!$order)
                $order = Order::create($model->firm_id);

            $model->order_id = $order->id;

            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'Продукта беше създаден успешно');
                return $this->redirect(['index']);
            }
        } else {
            $firms =ArrayHelper::map(Firm::find()->all(), 'id', 'name');
            $materials = ArrayHelper::map(Material::find()->all(), 'id', 'name');

            return $this->render('create', [
                'model' => $model,
                'firms' => $firms,
                'materials' => $materials
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Продукта беше обновен успешно');
            return $this->redirect(['index']);
        } else {
            $firms =ArrayHelper::map(Firm::find()->all(), 'id', 'name');
            $materials = ArrayHelper::map(Material::find()->all(), 'id', 'name');

            return $this->render('update', [
                'model' => $model,
                'firms' => $firms,
                'materials' => $materials
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Продукта беше изтрит успешно');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
