<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
    <!-- Category Create Section -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= 'Add Bill' ?></h3>
        </div>
        <?= form_open_multipart(route_to('operator_bill.create'), ['class' => 'form-horizontal']) ?>

        <div class="box-body">

            <!-- Year -->
            <div class="form-group">
                <label for="year" class="control-label col-sm-3">Year:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="year" id="year" required>
                </div>
            </div>

            <!-- Month -->
            <div class="form-group">
                <label for="month" class="control-label col-sm-3">Month:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="month" id="month" required>
                </div>
            </div>

            <!-- Client Name -->
            <div class="form-group">
                <label for="client_name" class="control-label col-sm-3">Client Name:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="client_name" id="client_name" required>
                </div>
            </div>

            <!-- Client Address -->
            <div class="form-group">
                <label for="client_address" class="control-label col-sm-3">Client Address:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="client_address" id="client_address" required>
                </div>
            </div>

            <!-- Successful Calls -->
            <div class="form-group">
                <label for="successful_calls" class="control-label col-sm-3">Successful Calls:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="successful_calls" id="successful_calls" required>
                </div>
            </div>

            <!-- Effective Duration -->
            <div class="form-group">
                <label for="effective_duration" class="control-label col-sm-3">Effective Duration (minutes):</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="effective_duration" id="effective_duration" required>
                </div>
            </div>

            <!-- Voice Amount -->
            <div class="form-group">
                <label for="voice_amount" class="control-label col-sm-3">Voice Amount:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="voice_amount" id="voice_amount" required>
                </div>
            </div>

            <!-- Voice Amount with VAT -->
            <div class="form-group">
                <label for="voice_amount_with_vat" class="control-label col-sm-3">Voice Amount with VAT:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="voice_amount_with_vat" id="voice_amount_with_vat" required>
                </div>
            </div>

            <!-- SMS Count -->
            <div class="form-group">
                <label for="sms_count" class="control-label col-sm-3">SMS Count:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="sms_count" id="sms_count" required>
                </div>
            </div>

            <!-- SMS Rate -->
            <div class="form-group">
                <label for="sms_rate" class="control-label col-sm-3">SMS Rate:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="sms_rate" id="sms_rate" required>
                </div>
            </div>

            <!-- SMS Amount -->
            <div class="form-group">
                <label for="sms_amount" class="control-label col-sm-3">SMS Amount:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="sms_amount" id="sms_amount" required>
                </div>
            </div>

            <!-- SMS Amount with VAT -->
            <div class="form-group">
                <label for="sms_amount_with_vat" class="control-label col-sm-3">SMS Amount with VAT:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="sms_amount_with_vat" id="sms_amount_with_vat" required>
                </div>
            </div>

            <!-- File Upload -->
            <div class="form-group">
                <label for="file_upload" class="control-label col-sm-3">File Upload:</label>
                <div class="col-sm-9">
                    <?= form_upload(['name' => 'file_upload', 'id' => 'file_upload', 'class' => 'form-control']) ?>
                </div>
            </div>
        </div>

        <?= view_cell(\App\Cells\FormSubmitCell::class, [
            'title' => ($action ?? null) === 'edit' ? 'Update' : 'Submit',
        ], 300) ?>
        <?= form_close() ?>
    </div>
<?= $this->endSection() ?>