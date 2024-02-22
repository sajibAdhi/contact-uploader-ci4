<?= $this->extend('layout/app') ?>

<?php helper('adminlte3'); ?>

<?= $this->section('pageStyles') ?>
<?= load_select2_styles() ?>
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
                        <code>from</code>,
                        <code>to</code>,
                        <code>operator_name</code>,
                        <code>content</code>,
                        <code>status</code>
                        headers.
                    </p>
                    <div class="progress progress-xs">
                        <div id="progress-bar" class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?= view_cell(\App\Cells\FormSubmitCell::class) ?>

        <?= form_close() ?>

    </div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<?= load_select2_scripts() ?>
<?= initialize_select2('selectTwo') ?>

    <script>
        $(document).ready(function () {

            // Update the progress bar
            function updateProgress() {
                $.ajax({
                    url: '<?= route_to('sms_service.import_data.progress')?>',
                    success: function (data) {
                        // Update your progress bar here
                        let progress = data.progress;
                        $('#progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);
                    }
                });
            }

            // Submit the form using AJAX
            $('#upload-form').submit(function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const category = $('#category');

                let intervalId;

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#upload-form').find('input, button').prop('disabled', true);
                        // Disable the Select2 dropdown
                        category.prop('disabled', true);
                        category.select2().trigger('change');

                        $('#progress-bar').css('width', '0%').attr('aria-valuenow', 0);
                        // Start the interval when the AJAX request starts call updateProgress every 5 second
                        intervalId = setInterval(updateProgress, 2000);
                    },
                    success: function (data) {
                        console.log(data);

                        // find and update csrf token
                        const csrfToken = data.csrf_token;
                        const csrfHash = data.csrf_hash;

                        $(`input[name="${csrfToken}"]`).val(csrfHash);
                        console.log($(`input[name="${csrfToken}"]`).val(), csrfToken, csrfHash);

                        if (data.status === 'success') {
                            Swal.fire({
                                title: "Notification",
                                text: `${data.message}`,
                                icon: "success"
                            });
                            $('#progress-bar').css('width', 100 + '%').attr('aria-valuenow', 100);
                            $('#upload-form').trigger('reset');
                        } else {
                            Swal.fire({
                                title: "Notification",
                                text: `${data.message}`,
                                icon: "error"
                            });
                        }

                    },
                    error: function (jqXHR) {
                        console.log(jqXHR);
                        // find and update csrf token
                        const data = jqXHR.responseJSON;
                        const csrfToken = data.csrf_token;
                        const csrfHash = data.csrf_hash;

                        $(`input[name="${csrfToken}"]`).val(csrfHash);
                        if (jqXHR.status === 422) { // If it's a validation error
                            const errors = jqXHR.responseJSON.errors;
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    Swal.fire({
                                        title: "Validation Error",
                                        text: `${errors[key]}`,
                                        icon: "error"
                                    });
                                }
                            }
                        } else {
                            Swal.fire({
                                title: "Notification",
                                text: `An error occurred while uploading the file`,
                                icon: "error"
                            });
                        }
                    },
                    complete: function () {
                        $('#upload-form').find('input, button').prop('disabled', false);
                        // Enable the Select2 dropdown
                        category.prop('disabled', false);
                        category.select2().trigger('change');

                        // Clear the interval when the AJAX request is completed
                        clearInterval(intervalId);
                    }
                });
            });
        });
    </script>

<?= $this->endSection() ?>