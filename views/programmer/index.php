<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Programmer';
$this->params['breadcrumbs'][] = $this->title;
?>
<h4>Programmer</h4>

<div class="card">
    <div class="card-header">
        Add Programming Skill Details
    </div>
    <div class="card-body">
        <?= Html::beginForm(Url::to(['/programmer/index']), 'post') ?>
        <div class="mb-3">
            <label for="nama_programmer" class="form-label">Enter Programmer Name</label>
            <?= Html::textInput('nama_programmer', '', ['class' => 'form-control', 'id' => 'nama_programmer', 'placeholder' => 'Programmer Name']) ?>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <button type="button" id="add-skill" class="btn btn-primary btn-sm">Add More Skill</button>
        </div>

        <div id="skills-container">
            <div class="row mb-3 skill-row">
                <div class="col-md-10">
                    <label for="programming_skill" class="form-label">Select Programming Skill</label>
                    <select class="form-control skill-select" name="programming_skill[]">
                        <option value="PHP">PHP</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="Python">Python</option>
                        <option value="Java">Java</option>
                        <option value="C++">C++</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    <button type="button" class="btn btn-danger btn-sm remove-skill" style="margin-top: 28px; margin-left: 50px;">Remove</button>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <?= Html::submitButton('Insert', ['class' => 'btn btn-success btn-sm']) ?>
        </div>
        <?= Html::endForm() ?>
    </div>
</div>

<?php
$this->registerCssFile('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$js = <<<JS
function initSelect2() {
    $('.skill-select').select2({
        placeholder: 'Select a skill',
        allowClear: true
    });
}

initSelect2();

$('#add-skill').on('click', function () {
    const skillsContainer = $('#skills-container');
    const skillRow = $(
        `<div class="row mb-3 skill-row">
            <div class="col-md-10">
                <label for="programming_skill" class="form-label">Select Programming Skill</label>
                <select class="form-control skill-select" name="programming_skill[]">
                    <option value="PHP">PHP</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="Python">Python</option>
                    <option value="Java">Java</option>
                    <option value="C++">C++</option>
                </select>
            </div>
            <div class="col-md-2 d-flex justify-content-center align-items-center">
                <button type="button" class="btn btn-danger btn-sm remove-skill" style="margin-top: 28px; margin-left: 50px;">Remove</button>
            </div>
        </div>`
    );
    skillsContainer.append(skillRow);

    initSelect2();
});

$(document).on('click', '.remove-skill', function () {
    $(this).closest('.skill-row').remove();
});
JS;
$this->registerJs($js);
?>
