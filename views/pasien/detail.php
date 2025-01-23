<?php

use yii\helpers\Html;

$this->title = 'Detail Pasien';
$this->params['breadcrumbs'][] = ['label' => 'Pasien', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-group">
    <div>
        <a href="/pasien/index" class="btn btn-secondary">
            < Kembali</a>
    </div>
</div>

<h4 class="mb-4">Detail Pasien</h4>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">No Rekam Medis :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->no_rekam_medis) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">No Identitas :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->no_identitas) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nama Pasien :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->nama_pasien) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Tempat Lahir :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->tempat_lahir) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <div class="form-control-plaintext"><?= Html::encode($model->tgl_lahir) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Umur</label>
            <div class="form-control-plaintext"><?= Html::encode($model->umur) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Jenis Kelamin :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->jenis_kelamin) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Agama :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->agama) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Pendidikan :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->pendidikan) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Pekerjaan :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->pekerjaan) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">No HP :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->no_hp) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Alamat :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->alamat) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Kewarganegaraan :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->kewarganegaraan) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Provinsi</label>
            <div class="form-control-plaintext"><?= Html::encode($model->provinsi) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Kabupaten :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->kabupaten) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Kecamatan :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->kecamatan) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Kelurahan :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->kelurahan) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Status Perkawinan :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->marital_status) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nama Ayah :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->nama_ayah) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Nama Ibu :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->nama_ibu) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label class="form-label">Riwayat Penyakit</label>
            <div class="form-control-plaintext"><?= Html::encode($model->riwayat_penyakit) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Penanggung Pasien :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->penanggung_pasien) ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">No Kartu :</label>
            <div class="form-control-plaintext"><?= Html::encode($model->no_kartu) ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= Html::a('Lihat Berkas Penanggung Pasien', ['/pasien/view-file', 'file' => $model->berkas_penanggung_pasien], ['target' => '_blank', 'class' => 'btn btn-link']) ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= Html::a('Berkas', ['/pasien/view-file', 'file' => $model->no_kartu], ['target' => '_blank', 'class' => 'btn btn-link']) ?>
        </div>
    </div>
</div>

