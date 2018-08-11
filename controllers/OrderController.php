<?php

namespace app\controllers;

use app\commands\OfferXlsExport;
use app\commands\TransmissionAndAcceptanceProtocolXlsExport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;
use app\models\Order;
use app\models\OrderSearch;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends BaseController
{
    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->delete())
            Yii::$app->session->setFlash('success', "The order deleted!");
        else
            Yii::$app->session->setFlash('error', "There was a problem with deleting that order");
        return $this->redirect(['index']);
    }

    public function actionExport($id, $type)
    {
        $model = $this->findModel($id);
        if($model)
        {
            if($model->status == Order::STATUS_NEW && $type == Order::EXPORT_OFFER)
            {
                $model->status = Order::STATUS_PENDING;
                $model->update(false);
            }

            $fileName = $type ? 'Предавателно-Приемателен Прoтокол.xls' : 'Оферта.xls';
            $excelExport = $type ? new TransmissionAndAcceptanceProtocolXlsExport() : new OfferXlsExport();
            $excelExport->loadData($model);
            $excelExport = $excelExport->export();
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Cache-Control: cache, must-revalidate');
            header('Pragma: public');
            $writer = IOFactory::createWriter($excelExport, 'Xls');
            $writer->save('php://output');
            exit;
        }
    }

    public function actionFinishOrder($id)
    {
        $model = $this->findModel($id);

        $model->status = Order::STATUS_DONE;
        if($model->update(false))
            Yii::$app->session->setFlash('success', "The order was finished!");
        else
            Yii::$app->session->setFlash('error', "There was a problem with updating the order status");

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
