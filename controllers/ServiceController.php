<?php

namespace app\controllers;

use Yii;
use Mpdf\Mpdf;
use app\models\Service;
use yii\web\Controller;
use Mpdf\Output\Destination;
use app\models\ServiceDetail;
use app\components\ModelHelper;
use yii\data\ActiveDataProvider;

class ServiceController extends Controller
{
    public function actionCreate($id)
    {
        $model = new Service();

        if ($model->load(Yii::$app->request->post())) {
            // dd(Yii::$app->request->post());
            $model->pasien_id = $id;
            $isValid = $model->validate();

            if ($isValid) {
                
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    
                    if ($model->save(false)) {
                        
                        $serviceDetailData = Yii::$app->request->post()['ServiceDetail'];
                        
                        foreach ($serviceDetailData as $detail) {
                            $modelDetail = new ServiceDetail();
                            $modelDetail->attributes = $detail; 
                            $modelDetail->service_id = $model->id;

                            if (!$modelDetail->validate()) {
                                throw new \Exception('Validation failed for ServiceDetail: ' . json_encode($modelDetail->errors));
                            }

                            if (!$modelDetail->save()) {
                                throw new \Exception('Failed to save ServiceDetail.');
                            }
                        }
                    }
                    
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Data ditambahkan!');
                    return $this->redirect(['create', 'id' => $id]); 
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Gagal membuat layanan: ' . $e->getMessage());
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsDetail' => (empty($modelsDetail)) ? [new ServiceDetail()] : $modelsDetail,
        ]);
    }

    public function actionData()
    {
        $query = Service::find();

        $pagination = Yii::$app->request->get('start')
            ? ['page' => (Yii::$app->request->get('start') / 10), 'pageSize' => 10]
            : ['pageSize' => 10];

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination,
        ]);

        return $this->asJson([
            'draw' => Yii::$app->request->get('draw'),
            'recordsTotal' => $dataProvider->totalCount,
            'recordsFiltered' => $dataProvider->totalCount,
            'data' => $dataProvider->getModels()
        ]);
    }

    public function actionCetak($id)
    {
        $serviceDetail = ServiceDetail::find()->where(['service_id' => $id])->all();
        // dd($serviceDetail);

        if (!$serviceDetail) {
            throw new \yii\web\NotFoundHttpException('Data tidak ditemukan.');
        }

        $html = $this->renderPartial('cetak_formulir_pdf', [
            'service' => $serviceDetail,
        ]);

        $mpdf = new Mpdf([
            'format' => [210, 330]
        ]);

        $mpdf->SetMargins(10, 10, 10);

        $mpdf->WriteHTML($html);

        return $mpdf->Output('cetak-formulir.pdf', \Mpdf\Output\Destination::INLINE);
    }

    
}
