<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
    <!-- Category Create Section -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= 'Add Operator Bill' ?></h3>
        </div>
        <?= form_open_multipart(route_to('operator_bill.create'), ['class' => 'form-horizontal']) ?>

        <div class="box-body">

            <!-- Operator -->
            <div class="form-group">
                <label for="operator_id" class="control-label col-sm-3">
                    Operator: <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <select name="operator_id" id="operator_id" class="form-control" required>
                        <?php if (!empty($operators)): ?>
                            <option value="">Select Operator</option>
                            <?php foreach ($operators as $operator): ?>
                                <option value="<?= $operator->id ?>"><?= $operator->name ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">No Operator Found</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- Year -->
            <div class="form-group">
                <label for="year" class="control-label col-sm-3">
                    Year: <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="year" id="year" pattern="[0-9]{4}" required>
                </div>
            </div>

            <!-- Month -->
            <div class="form-group">
                <label for="month" class="control-label col-sm-3">
                    Month: <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="month" id="month" min="1" max="12" required>
                </div>
            </div>

            <!-- Successful Calls -->
            <div class="form-group">
                <label for="successful_calls" class="control-label col-sm-3">Successful Calls:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="successful_calls" id="successful_calls">
                </div>
            </div>

            <!-- Effective Duration -->
            <div class="form-group">
                <label for="effective_duration" class="control-label col-sm-3">Effective Duration (minutes):</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="effective_duration" id="effective_duration">
                </div>
            </div>

            <!-- Voice Amount -->
            <div class="form-group">
                <label for="voice_amount" class="control-label col-sm-3">Voice Amount:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="voice_amount" id="voice_amount">
                </div>
            </div>

            <!-- Voice Amount with VAT -->
            <div class="form-group">
                <label for="voice_amount_with_vat" class="control-label col-sm-3">Voice Amount with VAT:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="voice_amount_with_vat" id="voice_amount_with_vat">
                </div>
            </div>

            <!-- SMS Count -->
            <div class="form-group">
                <label for="sms_count" class="control-label col-sm-3">SMS Count:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="sms_count" id="sms_count" >
                </div>
            </div>

            <!-- SMS Rate -->
            <div class="form-group">
                <label for="sms_rate" class="control-label col-sm-3">SMS Rate:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="sms_rate" id="sms_rate" >
                </div>
            </div>

            <!-- SMS Amount -->
            <div class="form-group">
                <label for="sms_amount" class="control-label col-sm-3">SMS Amount:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="sms_amount" id="sms_amount" >
                </div>
            </div>

            <!-- SMS Amount with VAT -->
            <div class="form-group">
                <label for="sms_amount_with_vat" class="control-label col-sm-3">SMS Amount with VAT:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="sms_amount_with_vat" id="sms_amount_with_vat">
                </div>
            </div>

            <!-- File Upload -->
            <div class="form-group">
                <label for="file_upload" class="control-label col-sm-3">File Upload:</label>
                <div class="col-sm-9">
                    <?= form_upload(['name' => 'file_upload[]', 'id' => 'file_upload', 'class' => 'form-control', 'multiple' => 'multiple']) ?>
                </div>
            </div>

            <style>
                .responsive-preview {
                    width: 100%;
                    height: auto;
                }
                .preview-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 10px; /* adjust as needed */
                }
            </style>
            <div class="form-group">
                <label class="control-label col-sm-3">File Preview:</label>
                <div class="col-sm-9 preview-grid" id="file_preview">
                    <!-- File previews will be added here -->
                </div>
            </div>

        </div>

        <?= view_cell(\App\Cells\FormSubmitCell::class, [
            'title' => ($action ?? null) === 'edit' ? 'Update' : 'Submit',
        ], 300) ?>

        <?= form_close() ?>

    </div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
    <script>
        document.getElementById('file_upload').addEventListener('change', function(e) {
            // Get the selected files
            var files = e.target.files;

            // Get the file preview container
            var previewContainer = document.getElementById('file_preview');

            // Clear the preview container
            previewContainer.innerHTML = '';

            // Loop through each file
            for (var i = 0; i < files.length; i++) {
                // Check the file type
                if (files[i].type.startsWith('image/')) {
                    // Create a new image element for image files
                    var img = document.createElement('img');
                    img.src = URL.createObjectURL(files[i]);
                    img.className = 'responsive-preview'; // Add the responsive-preview class
                    previewContainer.appendChild(img);
                } else if (files[i].type === 'application/pdf') {
                    // Create a new object element for PDF files
                    var obj = document.createElement('object');
                    obj.data = URL.createObjectURL(files[i]);
                    obj.className = 'responsive-preview'; // Add the responsive-preview class
                    previewContainer.appendChild(obj);
                }
            }
        });
    </script>
<?= $this->endSection() ?>