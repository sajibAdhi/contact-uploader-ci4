<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>
    <div class="card card-default">
        <?= view_cell(\App\Cells\CardHeaderCell::class, ['title' => "Create Product"]) ?>

        <?= form_open(route_to('product.store'), ['class' => 'form-horizontal']) ?>

        <div class="card-body">
            <!-- name -->
            <div class="form-group row <?= validation_show_error('name') ? 'has-error' : '' ?>">
                <label for="name" class="col-sm-3">Name</label>
                <div class="col-sm-9">

                    <input type="text" name="name" id="name" class="form-control"
                           value="<?= old('name') ?>">
                    <?php if (validation_show_error('name')): ?>
                        <span class="help-block has-error">
                            <?= validation_show_error('name') ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <!-- description -->
            <div class="form-group row <?= validation_show_error('description') ? 'has-error' : '' ?>">
                <label for="description" class="col-sm-3">Description</label>
                <div class="col-sm-9">
                    <input type="text" name="description" id="description" class="form-control"
                           value="<?= old('description') ?>">
                    <?php if (validation_show_error('description')): ?>
                        <span class="help-block has-error">
                            <?= validation_show_error('description') ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?= view_cell(\App\Cells\FormSubmitCell::class) ?>

        <?= form_close() ?>
    </div>

<?= $this->endSection() ?>