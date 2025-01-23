<?php

namespace app\controllers;

use Yii;
use app\models\Programmer;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ApiController extends Controller
{
    public function actionIndex()
    {

        return $this->render('index');
    }
}
