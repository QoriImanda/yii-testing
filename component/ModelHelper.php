<?php

namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;

class ModelHelper
{
    /**
     * Membuat banyak model untuk setiap entri yang ada di dalam POST data.
     *
     * @param string $modelClass Nama kelas model yang akan dibuat
     * @return array Daftar model yang baru dibuat
     */
    public static function createMultiple($modelClass)
    {
        $models = [];
        $count = Yii::$app->request->post($modelClass) ? count(Yii::$app->request->post($modelClass)) : 0;

        for ($i = 0; $i < $count; $i++) {
            $models[] = new $modelClass();
        }

        return $models;
    }

    /**
     * Memuat data POST untuk banyak model.
     *
     * @param array $models Daftar model yang akan di-load
     * @param array $data Data POST yang akan dimuat
     * @return bool Status apakah pemuatan data berhasil
     */
    public static function loadMultiple($models, $data)
    {
        foreach ($models as $index => $model) {
            $modelData = ArrayHelper::getValue($data, $model->formName() . "[{$index}]");
            if (!$model->load($modelData)) {
                Yii::trace("Gagal memuat data untuk model ke-{$index}: " . print_r($modelData, true));
                return false; // Kembalikan false jika ada model yang gagal dimuat
            }
        }
        return true;
    }

    /**
     * Melakukan validasi untuk banyak model.
     *
     * @param array $models Daftar model yang akan divalidasi
     * @return bool Status apakah semua model valid
     */
    public static function validateMultiple($models)
    {
        foreach ($models as $model) {
            if (!$model->validate()) {
                Yii::trace("Validasi gagal pada model: " . print_r($model->errors, true));
                return false; // Jika validasi gagal, kembalikan false
            }
        }
        return true;
    }
}

