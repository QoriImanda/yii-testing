<?php

namespace app\controllers;

use Yii;
use app\models\Programmer;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ProgrammerController extends Controller
{
    public function actionIndex()
    {
        $model = new Programmer();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                $model->programming_skill = implode(',', Yii::$app->request->post('programming_skill', []));

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Programmer data saved successfully.');
                } else {
                    Yii::$app->session->setFlash('error', 'There was an error saving the data.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Please fix the errors in the form.');
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
