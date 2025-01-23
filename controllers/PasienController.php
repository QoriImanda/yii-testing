<?php

namespace app\controllers;

use Yii;
use app\models\Pasien;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class PasienController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        return $this->render('index');
    }

    public function actionData()
    {
        $query = Pasien::find();

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

    public function actionCreate()
    {
        $model = new Pasien();  

        if ($model->load(Yii::$app->request->post())) {
            $model->berkas_penanggung_pasien = UploadedFile::getInstance($model, 'berkas_penanggung_pasien');
            $model->berkas = UploadedFile::getInstance($model, 'berkas');

            if ($model->validate()) {
                $model->uploadFiles();

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Data Pasien berhasil ditambahkan!');
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        $oldBerkasPenanggungPasien = $model->berkas_penanggung_pasien;
        $oldBerkas = $model->berkas;

        if ($model->load(Yii::$app->request->post())) {
            $model->berkas_penanggung_pasien = UploadedFile::getInstance($model, 'berkas_penanggung_pasien');
            $model->berkas = UploadedFile::getInstance($model, 'berkas');

            if ($model->validate()) {
                if ($model->berkas_penanggung_pasien) {
                    $model->uploadFiles();
                } else {
                    $model->berkas_penanggung_pasien = $oldBerkasPenanggungPasien;
                }

                if ($model->berkas) {
                    $model->uploadFiles(); 
                } else {
                    $model->berkas = $oldBerkas;
                }

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Data Pasien berhasil diperbarui!');
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('edit', ['model' => $model]);
    }

    public function actionDetail($id)
    {
        $model = $this->findModel($id);

        return $this->render('detail', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model) {
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', 'Data Pasien berhasil dihapus!');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menghapus data Pasien.');
            }
        }

        return $this->redirect(['index']);
    }



    protected function findModel($id)
    {
        if (($model = Pasien::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
