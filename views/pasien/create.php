<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Create';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-group">
    <div>
        <a href="/pasien/index" class="btn btn-secondary">
            < Kembali</a>
    </div>
</div>

<h4>Create Data Pasien</h4>

<div class="container mt-5">
    <?php $form = ActiveForm::begin([
        'id' => 'pasien-form',
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'no_rekam_medis')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'no_identitas')->textInput(['type' => 'number']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'nama_pasien')->textInput() ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'tempat_lahir')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'tgl_lahir')->input('date') ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'umur')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'jenis_kelamin')->radioList(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']) ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'agama')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'pendidikan')->textInput() ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'pekerjaan')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'no_hp')->textInput() ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'alamat')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'kewarganegaraan')->textInput() ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'provinsi')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'kabupaten')->textInput() ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'kecamatan')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'kelurahan')->textInput() ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'marital_status')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'nama_ayah')->textInput() ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'nama_ibu')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'riwayat_penyakit')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'penanggung_pasien')->textInput() ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'no_kartu')->textInput(['type' => 'number']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'berkas_penanggung_pasien')->fileInput() ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'berkas')->fileInput() ?>
        </div>
    </div>

    <div class="text-center">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary me-2']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
