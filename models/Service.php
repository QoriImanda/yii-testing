<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Service extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%service}}';
    }

    public function rules()
    {
        return [
            [['pasien_id', 'date'], 'required'],
            [['pasien_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    public function getServiceDetails()
    {
        return $this->hasMany(ServiceDetail::class, ['service_id' => 'id']);
    }
}
