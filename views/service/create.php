<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $modelsDetail app\models\ServiceDetail[] */

$this->title = 'Layanan';
$this->params['breadcrumbs'][] = ['label' => 'Pasien', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-group">
    <div>
        <a href="/pasien/index" class="btn btn-secondary">
            &lt; Kembali
        </a>
    </div>
</div>

<div class="service-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <!-- Input untuk tanggal layanan -->
    <?= $form->field($model, 'date')->input('date') ?>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-item',
        'deleteButton' => '.remove-item',
        'model' => $modelsDetail[0],
        'formId' => 'dynamic-form',
        'formFields' => ['layanan'],
    ]); ?>

    <h3 class="panel-title">
        Detail Layanan

    </h3>

    <div class="container-items">
        <?php foreach ($modelsDetail as $i => $modelDetail): ?>
            <div class="item panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <button type="button" class="add-item btn btn-success btn-sm">
                            +
                        </button>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-sm">
                            -
                        </button>
                    </h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (!$modelDetail->isNewRecord) {
                        echo Html::activeHiddenInput($modelDetail, "[{$i}]id");
                    }
                    ?>

                    <!-- Input untuk layanan -->
                    <?= $form->field($modelDetail, "[{$i}]layanan")->dropDownList([
                        'Konsul & Fisioterapi' => 'Konsul & Fisioterapi',
                        'Reassessment & Fisioterapi' => 'Reassessment & Fisioterapi',
                    ], ['prompt' => 'Pilih Jenis Layanan']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<table id="layanan" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Tanggal Formulir</th>
            <th>Aksi</th> <!-- Add Action Column -->
        </tr>
    </thead>
    <tbody>
        <!-- Data will be populated here dynamically -->
    </tbody>
    <tfoot>
        <tr>
            <th>Tanggal Formulir</th>
            <th>Aksi</th> <!-- Add Action Column -->
        </tr>
    </tfoot>
</table>

<?php
$this->registerJs("
    new DataTable('#layanan', {
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: '/service/data',
            type: 'GET'
        },
        columns: [
            { data: 'date' },
            // {
            //     data: 'berkas_penanggung_pasien',
            //     render: function(data, type, row) {
            //         return data ? '<a href=\"/' + data + '\" target=\"_blank\">Lihat</a>' : 'No File';
            //     }
            // },
            // {
            //     data: 'berkas',
            //     render: function(data, type, row) {
            //         return data ? '<a href=\"/' + data + '\" target=\"_blank\">Lihat</a>' : 'No File';
            //     }
            // },
            {
                data: 'id',  // Assuming 'id' is the identifier of the patient
                render: function(data, type, row) {
                    return '<a href=\"cetak/' + data + '\" target=\"_blank\" class=\"btn btn-info btn-sm\">Cetak</a>';
                }
            }
        ]
    });
");
?>