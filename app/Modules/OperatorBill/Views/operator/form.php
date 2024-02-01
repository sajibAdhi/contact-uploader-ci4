<?= $this->extend('layout/app') ?>


<?= $this->section('main') ?>
    <!-- Operator Create Section -->
    <div class="card  card-default">
        <div class="card-header">
            <h3 class="card-title"><?= (($action ?? null) == 'edit') ? 'Edit' : 'Add' ?> Operator</h3>
        </div>

        <?= form_open(current_url(), ['class' => 'form-horizontal'], isset($operator->id) ? ['id' => $operator->id] : []) ?>

        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger">
                    <?= validation_list_errors() ?>
                </div>
            <?php endif; ?>

            <!-- Operator Type -->
            <div class="form-group row">
                <label for="operator_type" class="control-label col-sm-3">
                    Operator Type: <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <select name="operator_type" id="operator_type" class="form-control" required>
                        <?php if (!empty($operatorTypes)): ?>
                            <option value="">Select Operator</option>
                            <?php foreach ($operatorTypes as $operatorType): ?>
                                <option value="<?= $operatorType ?>"><?= strtoupper($operatorType) ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">No Operator Type Found</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- Operator Name -->
            <div class="form-group row">
                <label for="operator_name" class="control-label col-sm-3">
                    Operator Name: <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="operator_name" id="operator_name"
                           value="<?= set_value('operator_name', $operator->name ?? null) ?>" required>
                </div>
            </div>

            <!-- Operator Address -->
            <div class="form-group row">
                <label for="operator_address" class="control-label col-sm-3">Operator Address:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="operator_address" id="operator_address"
                           value="<?= set_value('operator_address', $operator->address ?? null) ?>">
                </div>
            </div>

            <!-- Operator Phone -->
            <div class="form-group row">
                <label for="operator_phone" class="control-label col-sm-3">Operator Phone:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="operator_phone" id="operator_phone"
                           value="<?= set_value('operator_phone', $operator->phone ?? null) ?>">
                </div>
            </div>

            <!-- Operator Email -->
            <div class="form-group row">
                <label for="operator_email" class="control-label col-sm-3">Operator Email:</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="operator_email" id="operator_email"
                           value="<?= set_value('operator_email', $operator->email ?? null) ?>">
                </div>
            </div>

        </div>

        <?= view_cell(\App\Cells\FormSubmitCell::class, [
            'title' => ($action ?? null) === 'edit' ? 'Update' : 'Submit',
        ], 300) ?>

        <?= form_close() ?>
    </div>
<?= $this->endSection() ?>