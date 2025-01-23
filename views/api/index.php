<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'API';
$this->params['breadcrumbs'][] = $this->title;
?>
<h4>API</h4>

<div class="card">
    <div class="card-header">
        Add Programming Skill Details
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <select class="form-control skill-select" id="provinsi" name="provinsi">
                <option value="">Loading...</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="kota" class="form-label">Kota/Kabupaten</label>
            <select class="form-control skill-select" id="kota" name="kota">
                <option value="">Select a province first</option>
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-10">
                <label for="rumah_sakit" class="form-label">Rumah Sakit</label>
                <select class="form-control skill-select" id="rumah_sakit" name="rumah_sakit">
                    <option value="">Select a hospital first</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="type_hospital" class="form-label">Type</label>
                <select class="form-control skill-select" id="type_hospital" name="type_hospital">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3 mt-3">
    <div class="col-md-10">
        <h5 class="mt-2">Ruangan</h5>
    </div>
    <div class="col-md-2">
        <label for="type_room" class="form-label">Type</label>
        <select class="form-control skill-select" id="type_room" name="type_room">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="ruangan" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Bed Available</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here dynamically -->
            </tbody>
            <tfoot>
                <tr>
                    <th>Status</th>
                    <th>Bed Available</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


<?php
$this->registerCssFile('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$js = <<<JS
function initSelect2() {
    $('.skill-select').select2({
        placeholder: 'Select an option',
        allowClear: true
    });
}

function loadProvinces() {
    const provinceSelect = $('#provinsi');
    provinceSelect.html('<option value="">Loading...</option>');

    $.ajax({
        url: 'https://rs-bed-covid-api.vercel.app/api/get-provinces',
        method: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            if (data.provinces) {
                provinceSelect.html('<option value="">Select a province</option>');
                data.provinces.forEach(function(province) {
                    provinceSelect.append(`<option value="\${province.id}">\${province.name}</option>`);
                });
            } else {
                provinceSelect.html('<option value="">No data available</option>');
            }
        },
        error: function() {
            provinceSelect.html('<option value="">Error loading data</option>');
        }
    });
}

function loadCities(provinceId) {
    const citySelect = $('#kota');
    citySelect.html('<option value="">Loading...</option>');

    if (!provinceId) {
        citySelect.html('<option value="">Select a province first</option>');
        return;
    }

    $.ajax({
        url: `https://rs-bed-covid-api.vercel.app/api/get-cities?provinceid=\${provinceId}`,
        method: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            if (data.cities) {
                citySelect.html('<option value="">Select a city</option>');
                data.cities.forEach(function(city) {
                    citySelect.append(`<option value="\${city.id}">\${city.name}</option>`);
                });
            } else {
                citySelect.html('<option value="">No data available</option>');
            }
        },
        error: function() {
            citySelect.html('<option value="">Error loading data</option>');
        }
    });
}

function loadHospitals(provinceId, cityId, typeHospital) {
    const hospitalSelect = $('#rumah_sakit');
    hospitalSelect.html('<option value="">Loading...</option>');

    if (!provinceId || !cityId) {
        hospitalSelect.html('<option value="">Select a city first</option>');
        return;
    }

    $.ajax({
        url: `https://rs-bed-covid-api.vercel.app/api/get-hospitals?provinceid=\${provinceId}&cityid=\${cityId}&type=\${typeHospital}`,
        method: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            if (data.hospitals) {
                hospitalSelect.html('<option value="">Select a hospital</option>');
                data.hospitals.forEach(function(hospital) {
                    hospitalSelect.append(`<option value="\${hospital.id}">\${hospital.name}</option>`);
                });
            } else {
                hospitalSelect.html('<option value="">No data available</option>');
            }
        },
        error: function() {
            hospitalSelect.html('<option value="">Error loading data</option>');
        }
    });
}

function initializeDataTable(hospitalId, typeRoom) {
    const tableElement = document.querySelector('#ruangan');
    if (tableElement) {
        if (window.dtInstance) {
            window.dtInstance.clear().destroy(); 
        }

        window.dtInstance = new DataTable(tableElement, {
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            processing: true,
            serverSide: false,
            ajax: {
                url: 'https://rs-bed-covid-api.vercel.app/api/get-bed-detail',
                type: 'GET',
                data: {
                    hospitalid: hospitalId,
                    type: typeRoom
                },
                dataSrc: function(response) {
                    console.log(response.data.bedDetail);
                    return response.data.bedDetail || []; 
                }
            },
            columns: [
                { data: 'stats.title', title: 'Stats' },
                { data: 'stats.bed_available', title: 'Bed Available' },
            ]
        });
    }
}

$('#provinsi').on('change', function() {
    const selectedProvinceId = $(this).val();
    $('#rumah_sakit').html('<option value="">Select a hospital first</option>'); 
    $('#kota').html('<option value="">Select a province first</option>');
    loadCities(selectedProvinceId); 
});

$('#kota').on('change', function() {
    const selectedProvinceId = $('#provinsi').val();
    const selectedCityId = $(this).val();
    $('#rumah_sakit').html('<option value="">Select a hospital first</option>'); 
    const selectedTypeHospital = $('#type_hospital').val();
    loadHospitals(selectedProvinceId, selectedCityId, selectedTypeHospital); 
});

$('#type_hospital').on('change', function() {
    const selectedProvinceId = $('#provinsi').val();
    const selectedCityId = $('#kota').val();
    const selectedTypeHospital = $(this).val();
    loadHospitals(selectedProvinceId, selectedCityId, selectedTypeHospital); 
});

$('#type_room').on('change', function() {
    const selectedHospitalId = $('#rumah_sakit').val();
    const selectedTypeRoom = $(this).val();
    if (selectedHospitalId) {
        initializeDataTable(selectedHospitalId, selectedTypeRoom); 
    }
});

$('#rumah_sakit').on('change', function() {
    const selectedHospitalId = $(this).val();
    const selectedTypeRoom = $('#type_room').val();
    if (selectedHospitalId) {
        initializeDataTable(selectedHospitalId, selectedTypeRoom); 
    }
});

$(document).ready(function() {
    initSelect2();
    loadProvinces();

    initializeDataTable();
});
JS;
$this->registerJs($js);
?>