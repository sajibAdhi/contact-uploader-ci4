<?= $this->extend('layout/app') ?>


<?= $this->section('content') ?>
    <!-- Category Create Section -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= 'Add Operator Bill' ?></h3>
        </div>
        <?= form_open_multipart(route_to('operator_bill.create'), ['class' => 'form-horizontal']) ?>

        <div class="box-body">

            <!-- SBN -->
            <div class="form-group">
                <label for="sbn" class="control-label col-sm-3">
                    SBN: <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <select name="sbn" id="sbn" class="form-control" required>
                        <?php if (!empty($sbnList)): ?>
                            <option value="">Select SBN</option>
                            <?php foreach ($sbnList as $sbn): ?>
                                <option value="<?= $sbn ?>"><?= strtoupper($sbn) ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">No SBN Found</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- Operator Type -->
            <div class="form-group">
                <label for="operator_type" class="control-label col-sm-3">
                    Operator Type: <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <select name="operator_type" id="operator_type" class="form-control" required>
                        <?php if (!empty($operatorTypes)): ?>
                            <option value="">Select Operator Type</option>
                            <?php foreach ($operatorTypes as $operatorType): ?>
                                <option value="<?= $operatorType ?>"><?= strtoupper($operatorType) ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">No Operator Type Found</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- Operator -->
            <div class="form-group">
                <label for="operator_id" class="control-label col-sm-3">
                    Operator: <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <select name="operator_id" id="operator_id" class="form-control" required>
                        <option value="">Select a Operator Type First</option>
                    </select>
                </div>
            </div>

            <!-- Year -->
            <div class="form-group">
                <label for="year" class="control-label col-sm-3">
                    Year: <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <select class="form-control" name="year" id="year" required>
                        <option value="">Select Year</option>
                        <!-- option from 2030 to 2020-->
                        <?php for ($year = 2030; $year >= 2020; $year--): ?>
                            <option value="<?= $year ?>" <?= (date('Y') == $year) ? 'selected' : null ?>><?= $year ?></option>
                        <?php endfor; ?>
                    </select>

                </div>
            </div>

            <!-- Month -->
            <div class="form-group">
                <label for="month" class="control-label col-sm-3">
                    Month: <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <select class="form-control" name="month" id="month">
                        <option value="">Select Month</option>
                        <!-- option from 01 to 12-->
                        <?php for ($month = 1; $month <= 12; $month++): ?>
                            <option value="<?= $month ?>" <?= (date('m') == $month) ? 'selected' : null ?>><?= $month ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <!-- Voice Section using {successful_calls, effective_duration, voice_amount, voice_amount_with_vat} -->
            <section class="hide" id="voiceSection">
                <!-- successful_calls -->
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
                        <input type="number" class="form-control" name="voice_amount_with_vat"
                               id="voice_amount_with_vat">
                    </div>
                </div>
            </section>

            <!-- SMS Section using {sms_count, sms_amount, sms_amount_with_vat} -->
            <section class="hide" id="smsSection">
                <!-- sms_count -->
                <div class="form-group">
                    <label for="sms_count" class="control-label col-sm-3">SMS Count:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="sms_count" id="sms_count">
                    </div>
                </div>

                <!-- sms_amount -->
                <div class="form-group">
                    <label for="sms_amount" class="control-label col-sm-3">SMS Amount:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="sms_amount" id="sms_amount">
                    </div>
                </div>

                <!-- sms_amount_with_vat -->
                <div class="form-group">
                    <label for="sms_amount_with_vat" class="control-label col-sm-3">SMS Amount with VAT:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="sms_amount_with_vat" id="sms_amount_with_vat">
                    </div>
                </div>
            </section>


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
    <!-- show voice or sms or both based on sbn
            RITT -> FORM {voice,sms}
            QTECH -> FORM {sms}
            IGW -> FORM {voice}
            ICX -> FORM {voice}
     -->
    <script>
        $(document).ready(function () {
            $('#sbn').on('change', function () {
                const sbn = $(this).val();
                if (sbn === `<?= \OperatorBill\Constants\SBNConstant::RITT ?>`) {
                    $('#voiceSection').removeClass('hide');
                    $('#smsSection').removeClass('hide');
                } else if (sbn === `<?= \OperatorBill\Constants\SBNConstant::QTECH ?>`) {
                    $('#voiceSection').addClass('hide');
                    $('#smsSection').removeClass('hide');
                } else if (sbn === `<?= \OperatorBill\Constants\SBNConstant::RITIGW ?>` || sbn === `<?= \OperatorBill\Constants\SBNConstant::SOFTEX ?>`) {
                    $('#voiceSection').removeClass('hide');
                    $('#smsSection').addClass('hide');
                } else {
                    $('#voiceSection').addClass('hide');
                    $('#smsSection').addClass('hide');
                }
            });
        });
    </script>

    <!-- on operator_type change get operators -->
    <script>
        $(document).ready(function () {
            $('#operator_type').on('change', function () {
                const operatorType = $(this).val();
                console.log(operatorType);
                if (operatorType !== '') {
                    $.ajax({
                        url: `<?= route_to('operator_bill.operator.get_operators') ?>`,
                        type: 'GET',
                        data: {
                            operator_type: operatorType
                        },
                        success: function (response) {
                            if (response) {
                                let operators = response.data;
                                let operatorOptions = '<option value="">Select Operator</option>';

                                operators.forEach(operator => {
                                    operatorOptions += `<option value="${operator.id}">${operator.name}</option>`;
                                });

                                $('#operator_id').html(operatorOptions);
                            } else {

                                $('#operator_id').html('<option value="">No Operator Found</option>');
                            }
                        },
                        error: function (error) {
                            console.error(error);
                            // show Toastr error to end user
                            toastr.error(error.responseJSON.message, 'Error');

                        }
                    });
                }

            });
        });
    </script>

    <!-- file_upload preview -->
    <script>
        document.getElementById('file_upload').addEventListener('change', function (e) {
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