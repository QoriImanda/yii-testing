<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

$roleUser = Yii::$app->user->identity->role;

$this->title = 'Pasien';
$this->params['breadcrumbs'][] = $this->title;
?>
<h4>Pasien</h4>

<div class="form-group">
    <div>
        <a href="/pasien/create" class="btn btn-primary">Create</a>
    </div>
</div>

<table id="pasien" class="display" style="width:100%">
    <thead>
        <tr>
            <th>No Rekam Medis</th>
            <th>No Identitas</th>
            <th>Nama Pasien</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <?php if ($roleUser == 'admin') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
        <tr>
            <th>No Rekam Medis</th>
            <th>No Identitas</th>
            <th>Nama Pasien</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <?php if ($roleUser == 'admin') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </tfoot>
</table>

<?php
$this->registerJs("
    var roleUser = '" . $roleUser . "'; // Ambil peran user ke dalam JavaScript

    var columns = [
        { data: 'no_rekam_medis' },
        { data: 'no_identitas' },
        { data: 'nama_pasien' },
        { data: 'umur' },
        { data: 'jenis_kelamin' }
    ];

    if (roleUser === 'admin') {
        columns.push({
            data: 'id',
            render: function(data, type, row) {
                return '<a href=\"/pasien/detail/' + data + '\" class=\"btn btn-info btn-sm\">Detail</a>' +
                       ' <a href=\"/pasien/service/' + data + '\" class=\"btn btn-primary btn-sm\">Layanan</a>' +
                       ' <a href=\"/pasien/edit/' + data + '\" class=\"btn btn-warning btn-sm\">Edit</a>' +
                       ' <a href=\"/pasien/delete/' + data + '\" class=\"btn btn-danger btn-sm\" onclick=\"return confirm(\'Are you sure?\')\">Delete</a>';
            }
        });
    }

    new DataTable('#pasien', {
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: '/pasien/data',
            type: 'GET'
        },
        columns: columns
    });
");
?>
