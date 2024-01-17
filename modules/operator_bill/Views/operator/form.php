<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
    <!-- Operator Create Section -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= (($action ?? null) == 'edit') ? 'Edit' : 'Add' ?> Operator</h3>
        </div>
        <?= form_open(current_url(), ['class' => 'form-horizontal']) ?>

        <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
                <?= validation_list_errors() ?>
            </div>
        <?php endif; ?>

        <div class="box-body">

            <!-- Operator Name -->
            <div class="form-group">
                <label for="operator_name" class="control-label col-sm-3">Operator Name:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="operator_name" id="operator_name"
                           value="<?= set_value('operator_name', $operator->name ?? null) ?>" required>
                </div>
            </div>

            <!-- Operator Address -->
            <div class="form-group">
                <label for="operator_address" class="control-label col-sm-3">Operator Address:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="operator_address" id="operator_address"
                           value="<?= set_value('operator_address', $operator->address ?? null) ?>" required>
                </div>
            </div>

            <!-- Operator Phone -->
            <div class="form-group">
                <label for="operator_phone" class="control-label col-sm-3">Operator Phone:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="operator_phone" id="operator_phone"
                           value="<?= set_value('operator_phone', $operator->phone ?? null) ?>" required>
                </div>
            </div>

            <!-- Operator Email -->
            <div class="form-group">
                <label for="operator_email" class="control-label col-sm-3">Operator Email:</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="operator_email" id="operator_email"
                           value="<?= set_value('operator_email', $operator->email ?? null) ?>" required>
                </div>
            </div>

        </div>

        <?= view_cell(\App\Cells\FormSubmitCell::class, [
            'title' => ($action ?? null) === 'edit' ? 'Update' : 'Submit',
        ], 300) ?>
        <?= form_close() ?>
    </div>
<?= $this->endSection() ?>