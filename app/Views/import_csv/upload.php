<?= $this->extend('layout/app') ?>

<?php helper('adminlte3'); ?>

<?= $this->section('pageStyles') ?>
<?= load_select2_styles()?>
<?= $this->endSection() ?>

<?= $this->section('main') ?>
    <div class="card card-default">

        <div class="card-header with-border">
            <h3 class="card-title">Import CSV File</h3>
        </div>

        <?= form_open_multipart(route_to('contact.content.upload'), ['id' => 'upload-form']) ?>

        <div class="card-body">
            <!-- Category -->
            <div class="form-group row <?= validation_show_error('category') ? 'has-warning' : '' ?>">
                <label for="category" class="control-label col-sm-3">Select a category:</label>
                <div class=" col-sm-9">
                    <select class="form-control selectTwo" name="category" id="category" style="width: 100%">
                        <option value="">Select a Category</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>" <?= set_select('category', $category->id) ?>>
                                    <?= $category->name ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <span class="help-block"><?= validation_show_error('category') ?></span>
                    <p class="help-block">Either select a Category or write a new Category name</p>
                </div>
            </div>

            <!-- Date -->
            <?= view_cell(\App\Cells\DateInputFieldCell::class, [
                'label' => 'Date',
                'id' => 'datepicker',
                'name' => 'date',
                'defaultValue' => date('Y-m-d'),
                'readonly' => true,
            ]) ?>

            <!-- Contacts File -->
            <div class="form-group row <?= validation_show_error('contacts_file') ? 'has-warning' : '' ?>">
                <label for="contacts" class="control-label col-sm-3">Contacts File:</label>
                <div class=" col-sm-9">
                    <input type="file" class="form-control" name="contacts_file" id="contacts"
                           accept=".csv,.xlsx" required>
                    <span class="help-block"><?= validation_show_error('contacts_file') ?></span>
                    <p class="help-block">
                        Please upload a CSV file which contains
                        <code>aggregator_name</code>,
                        <code>date</code>,
                        <code>from</code>,
                        <code>to</code>,
                        <code>operator_name</code>,
                        <code>sms_content</code>,
                        <code>status</code>
                        headers.
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

<?= $this->section('pageScripts') ?>
<?= load_select2_scripts()?>
<?= initialize_select2('selectTwo')?>
<?= $this->endSection() ?>