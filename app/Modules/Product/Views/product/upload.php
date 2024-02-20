<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>
    <div class="card card-default">
        <?= view_cell(\App\Cells\CardHeaderCell::class, ['title' => "Upload Product"]) ?>

        <?= form_open_multipart(route_to('product.upload'), ['class' => 'form-horizontal']) ?>

        <div class="card-body">
            <!-- Product File -->
            <div class="form-group <?= validation_show_error('product_file') ? 'has-warning' : '' ?>">
                <label for="product" class="control-label col-sm-3">Product File:</label>
                <div class=" col-sm-9">
                    <input type="file" class="form-control" name="product_file" id="product"
                           accept=".csv" required>
                    <span class="help-block
                    "><?= validation_show_error('product_file') ?></span>
                    <p class="help-block
                    ">Please upload a CSV file. The File must contain header <b>name</b> and <b>description</b>.
                    </p>
                    <div class="progress">
                        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated"
                             role="progressbar" style="width: 0%" aria-valuenow="0"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <?= view_cell(\App\Cells\FormSubmitCell::class) ?>

        <?= form_close() ?>
    </div>

<?= $this->endSection() ?>