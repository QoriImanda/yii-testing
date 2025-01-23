<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ProgramItem;

class ProgramItemWidget extends Widget
{
    public $form;
    public $model;

    public function run()
    {
        return $this->render('program_item', [
            'model' => $this->model,
            'form' => $this->form,
        ]);
    }
}
