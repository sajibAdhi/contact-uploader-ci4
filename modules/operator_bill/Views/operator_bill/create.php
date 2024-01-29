<?= $this->extend('layout/app') ?>


<?= $this->section('styles') ?>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/select2/css/select2.min.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="card card-default">

        <div class="card-header">
            <h3 class="card-title"><?= ($action ?? null) == 'edit' ? 'Edit' : 'Add' ?> Operator Bill</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- ./card-header -->

        <?= form_open_multipart(
            ($action ?? null) === 'edit'
                ? route_to('operator_bill.edit', $operatorBill->id ?? null) :
                route_to('operator_bill.create'),
            ['class' => 'form-horizontal']
        ) ?>

        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger">
                    <?= validation_list_errors() ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-sm-6">
                    <!-- sbu -->
                    <div class="form-group">
                        <label for="sbu">
                            SBU: <span class="text-danger">*</span>
                        </label>
                        <select name="sbu" id="sbu" class="form-control select2" required>
                            <?php if (!empty($sbuList)): ?>
                                <option value="">Select SBU</option>
                                <?php foreach ($sbuList as $sbu): ?>
                                    <option value="<?= $sbu ?>" <?= set_select('sbu', $sbu, ($operatorBill->sbu ?? null) == $sbu) ?>>
                                        <?= strtoupper($sbu) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="">No sbu Found</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Year -->
                    <div class="form-group">
                        <label for="year">
                            Year: <span class="text-danger">*</span>
                        </label>
                        <select name="year" id="year" class="form-control select2" required>
                            <option value="">Select Year</option>
                            <!-- option from 2030 to 2020-->
                            <?php for ($year = 2030; $year >= 2020; $year--): ?>
                                <option value="<?= $year ?>" <?= (old('year', date('Y')) == $year) ? 'selected' : null ?>><?= $year ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- Operator Type -->
                    <div class="form-group">
                        <label for="operator_type">
                            Operator Type: <span class="text-danger">*</span>
                        </label>
                        <select name="operator_type" id="operator_type" class="form-control select2" required>
                            <?php if (!empty($operatorTypes)): ?>
                                <option value="">Select Operator Type</option>
                                <?php foreach ($operatorTypes as $operatorType): ?>
                                    <option value="<?= $operatorType ?>" <?= set_select('operator_type', $operatorType) ?>>
                                        <?= strtoupper($operatorType) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="">No Operator Type Found</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Operator -->
                    <div class="form-group">
                        <label for="operator_id">
                            Operator: <span class="text-danger">*</span>
                        </label>
                        <select name="operator_id" id="operator_id" class="form-control select2" required>
                            <option value="">Select an Operator Type First</option>
                        </select>
                    </div>
                </div>

                <!-- Month -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="month">
                            Month: <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" name="month" id="month">
                            <option value="">Select Month</option>
                            <!-- option from 01 to 12-->
                            <?php for ($month = 1; $month <= 12; $month++): ?>
                                <option value="<?= $month ?>" <?= set_select('month', $month, ($operatorBill->month ?? date('m')) == $month) ?>>
                                    <?= $month ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <!-- successful_calls -->
                <div class="col-sm-6 voice-section d-none">
                    <div class="form-group">
                        <label for="successful_calls ">Successful Calls:</label>
                        <input type="number" class="form-control" name="successful_calls" id="successful_calls"
                               value="<?= set_value('successful_calls', $operatorBill->successful_calls ?? null) ?>">
                    </div>
                </div>

                <!-- Effective Duration -->
                <div class="col-sm-6 voice-section d-none">
                    <div class="form-group">
                        <label for="effective_duration">Effective Duration (minutes):</label>
                        <input type="number" class="form-control" name="effective_duration" id="effective_duration"
                               value="<?= set_value('effective_duration', $operatorBill->effective_duration ?? null) ?>">
                    </div>
                </div>

                <!-- Voice Amount -->
                <div class="col-sm-6 voice-section d-none">
                    <div class="form-group">
                        <label for="voice_amount">Voice Amount:</label>
                        <input type="number" class="form-control" name="voice_amount" id="voice_amount"
                               value="<?= set_value('voice_amount', $operatorBill->voice_amount ?? null) ?>">
                    </div>
                </div>

                <!-- Voice Amount with VAT -->
                <div class="col-sm-6 voice-section d-none">
                    <div class="form-group">
                        <label for="voice_amount_with_vat">Voice Amount with VAT:</label>
                        <input type="number" class="form-control" name="voice_amount_with_vat"
                               id="voice_amount_with_vat"
                               value="<?= set_value('voice_amount_with_vat', $operatorBill->voice_amount_with_vat ?? null) ?>">
                    </div>
                </div>


                <!-- sms_count -->
                <div class="col-sm-6 sms-section d-none">
                    <div class="form-group">
                        <label for="sms_count">SMS Count:</label>
                        <input type="number" class="form-control" name="sms_count" id="sms_count"
                               value="<?= set_value('sms_count', $operatorBill->sms_count ?? null) ?>">
                    </div>
                </div>

                <!-- sms_amount -->
                <div class="col-sm-6 sms-section d-none">
                    <div class="form-group">
                        <label for="sms_amount">SMS Amount:</label>
                        <input type="number" class="form-control" name="sms_amount" id="sms_amount"
                               value="<?= set_value('sms_amount', $operatorBill->sms_amount ?? null) ?>">
                    </div>

                </div>

                <!-- sms_amount_with_vat -->
                <div class="col-sm-6 sms-section d-none">
                    <div class="form-group">
                        <label for="sms_amount_with_vat">SMS Amount with VAT:</label>
                        <input type="number" class="form-control" name="sms_amount_with_vat" id="sms_amount_with_vat"
                               value="<?= set_value('sms_amount_with_vat', $operatorBill->sms_amount_with_vat ?? null) ?>">
                    </div>
                </div>
            </div>

            <!-- File Upload -->
            <div class="form-group">
                <label for="file_upload">File Upload:</label>

                <?= form_upload('file_upload[]', '', 'id="file_upload" class="form-control" accept="application/pdf,image/*" multiple="multiple"') ?>
            </div>

            <div class="form-group">
                <label>File Preview:</label>
                <div id="file_preview">
                </div>
            </div>

        </div>


        <?= view_cell(\App\Cells\FormSubmitCell::class, [
            'title' => ($action ?? null) == 'edit' ? 'Update' : 'Submit',
        ], 300) ?>

        <?= form_close() ?>

    </div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
    <!-- Select2 -->
    <script src="<?= base_url('adminlte/plugins/select2/js/select2.full.min.js') ?>"></script>

    <!-- Initialize Select2 Elements -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>

    <!-- show voice or sms or both based on sbu -->
    <!--
    RITT -> FORM {voice,sms}
    QTECH -> FORM {sms}
    IGW -> FORM {voice}
    ICX -> FORM {voice}
    -->
    <script>
        $(function () {
            let sbuField = $('#sbu');

            // show voice or sms or both based on sbu
            function setSbuForm() {
                const sbu = sbuField.val();
                console.log(sbu === `<?php echo \OperatorBill\Constants\SbuConstant::RITT ?>`);
                if (sbu === `<?php echo \OperatorBill\Constants\SbuConstant::RITT ?>`) {
                    $('.voice-section').removeClass('d-none');
                    $('.sms-section').removeClass('d-none');
                } else if (sbu === `<?php echo \OperatorBill\Constants\SbuConstant::QTECH ?>`) {
                    $('.voice-section').addClass('d-none');
                    $('.sms-section').removeClass('d-none');
                } else if (sbu === `<?php echo \OperatorBill\Constants\SbuConstant::RITIGW ?>` || sbu === `<?php echo \OperatorBill\Constants\SbuConstant::SOFTEX ?>`) {
                    $('.voice-section').removeClass('d-none');
                    $('.sms-section').addClass('d-none');
                } else {
                    $('.voice-section').addClass('d-none');
                    $('.sms-section').addClass('d-none');
                }
            }

            setSbuForm();

            sbuField.on('change', () => setSbuForm());

        });
    </script>

    <!-- on operator_type change get operators -->
    <script>
        $(function () {
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
        $('#file_upload').on('change', function () {
            const files = $(this)[0].files;
            let filePreview = '';
            for (let i = 0; i < files.length; i++) {
                const fileURL = URL.createObjectURL(files[i]);
                if (files[i].type === 'application/pdf') {
                    filePreview += `<div class="preview-block col-sm-2">
                <div class="preview-block__img">
                    <embed src="${fileURL}" type="application/pdf" width="100%" height="200px" />
                </div>
                <div class="preview-block__desc">
                    <span class="preview-block__title">${files[i].name}</span>
                    <span class="preview-block__size">${(files[i].size / 1024).toFixed(2)} KB</span>
                </div>
            </div>`;
                } else {
                    filePreview += `<div class="preview-block col-sm-2">
                <div class="preview-block__img">
                    <img class="img-fluid mb-2" src="${fileURL}" alt="File Preview">
                </div>
                <div class="preview-block__desc">
                    <span class="preview-block__title">${files[i].name}</span>
                    <span class="preview-block__size">${(files[i].size / 1024).toFixed(2)} KB</span>
                </div>
            </div>`;
                }
            }

            $('#file_preview').html(`<div class="row">${filePreview}</div>`);
        });
    </script>
<?= $this->endSection() ?>