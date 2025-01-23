<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Pasien extends ActiveRecord
{
    public $berkas_penanggung_pasien_file;
    public $berkas_file;

    public static function tableName()
    {
        return 'pasien';
    }

    public function rules()
    {
        return [
            [['no_rekam_medis', 'no_identitas', 'nama_pasien', 'tempat_lahir', 'umur', 'jenis_kelamin', 'agama', 'pendidikan', 'pekerjaan', 'no_hp', 'alamat', 'kewarganegaraan', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'marital_status', 'nama_ayah', 'nama_ibu'], 'required'],
            [['no_rekam_medis', 'no_identitas', 'no_kartu'], 'integer'],
            [['nama_pasien', 'tempat_lahir', 'agama', 'pendidikan', 'pekerjaan', 'alamat', 'kewarganegaraan', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'marital_status', 'nama_ayah', 'nama_ibu'], 'string', 'max' => 255],
            [['umur'], 'string', 'max' => 50],
            [['tgl_lahir'], 'safe'],
            [['riwayat_penyakit'], 'string'],
            // [['penanggung_pasien', 'berkas_penanggung_pasien', 'berkas']],
            [['jenis_kelamin'], 'in', 'range' => ['Laki-laki', 'Perempuan']],

            [['berkas_penanggung_pasien', 'berkas'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png, pdf', 'maxSize' => 1024 * 1024 * 2], // Max 2MB
        ];
    }

    public function uploadFiles()
    {
        $filePath = Yii::getAlias('@webroot') . '/file/'; 

        if (!is_dir($filePath)) {
            mkdir($filePath, 0777, true);
        }

        if ($this->berkas_penanggung_pasien) {
            $fileName = 'berkas_penanggung_pasien_' . time() . '.' . $this->berkas_penanggung_pasien->extension;
            if ($this->berkas_penanggung_pasien->saveAs($filePath . $fileName)) {
                $this->berkas_penanggung_pasien = 'file/' . $fileName;  
            } else {
                Yii::error('Upload file berkas_penanggung_pasien gagal');
                return false;
            }
        }

        if ($this->berkas) {
            $fileName = 'berkas_' . time() . '.' . $this->berkas->extension;
            if ($this->berkas->saveAs($filePath . $fileName)) {
                $this->berkas = 'file/' . $fileName;  
            } else {
                Yii::error('Upload file berkas gagal');
                return false;
            }
        }

        return true; 
    }
}

