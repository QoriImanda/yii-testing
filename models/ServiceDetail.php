<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class ServiceDetail extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%service_detail}}';
    }

    public function rules()
    {
        return [
            [['service_id', 'layanan'], 'required'],
            [['service_id'], 'integer'],
            [['layanan'], 'string', 'max' => 255],
        ];
    }

    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }
}
