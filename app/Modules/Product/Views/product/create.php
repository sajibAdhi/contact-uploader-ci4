<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>
    <div class="card card-default">
        <?= view_cell(\App\Cells\CardHeaderCell::class, ['title' => "Create Product"]) ?>

        <?= form_open(route_to('product.store'), ['class' => 'form-horizontal']) ?>

        <div class="card-body">
            <!-- category name -->
            <div class="form-group row <?= validation_show_error('category') ? 'has-error' : '' ?>">
                <label for="category" class="col-sm-3">Category :</label>
                <div class="col-sm-9">
                    <input type="text" name="category" id="category" class="form-control"
                           value="<?= old('category') ?>">
                    <span class="help-block has-error"><?= validation_show_error('category') ?></span>
                </div>
            </div>

            <!-- name -->
            <div class="form-group row <?= validation_show_error('name') ? 'has-error' : '' ?>">
                <label for="name" class="col-sm-3">
                    Name <span class="text-danger">*</span> :
                </label>
                <div class="col-sm-9">
                    <input type="text" name="name" id="name" class="form-control"
                           value="<?= old('name') ?>">
                    <span class="help-block has-error"><?= validation_show_error('name') ?></span>
                </div>
            </div>
            <!-- description -->
            <div class="form-group row <?= validation_show_error('description') ? 'has-error' : '' ?>">
                <label for="description" class="col-sm-3">Description</label>
                <div class="col-sm-9">
                    <input type="text" name="description" id="description" class="form-control"
                           value="<?= old('description') ?>">
                    <span class="help-block has-error"><?= validation_show_error('description') ?></span>
                </div>
            </div>
        </div>

        <?= view_cell(\App\Cells\FormSubmitCell::class) ?>

        <?= form_close() ?>
    </div>

<?= $this->endSection() ?>