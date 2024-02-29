<?= $this->extend('layout/app') ?>


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
                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0.0%">
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
<?= initialize_select2('.selectTwo') ?>

    <script>
        $(document).ready(function () {
            let uploadProgressInterval;
            let uploadStatusInterval;
            let identifier = '<?= date('Y-m-d') . auth()->id() ?>';

            // Update the progress bar
            function uploadProgress() {

                $.ajax({
                    url: '<?= route_to('sms_service.import_data.progress')?>',
                    type: 'GET',
                    data:{
                        identifier: identifier
                    },
                    success: function (data) {
                        // Update your progress bar here
                        let progress = data.progress ?? 0;
                        $('#progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);
                    }
                });
            }

            // Update the status
            function uploadStatus() {
                $.ajax({
                    url: '<?= route_to('sms_service.import_data.status')?>',
                    type: 'GET',
                    data:{
                        identifier: identifier
                    },
                    success: function (data) {
                        // Update your progress bar here
                        let status = data.status;
                        if (status !== null) {
                            Swal.fire({
                                title: "Notification",
                                text: `${status}`,
                                icon: "info"
                            });
                        }
                    }
                });
            }

            // Submit the form using AJAX
            $('#upload-form').submit(function (event) {
                event.preventDefault();

                const formData = new FormData(this);
                const category = $('#category');

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
                        category.prop('disabled', true);

                        $('#progress-bar').css('width', '0%').attr('aria-valuenow', 0);

                        // Call updateProgress immediately when the AJAX request starts
                        // Start the interval when the AJAX request completes successfully
                        uploadProgressInterval = setTimeout(uploadProgress, 5000);
                        uploadStatusInterval = setInterval(uploadStatus, 2000);
                    },
                    success: function (data) {
                        // Update CSRF token
                        const csrfToken = data.csrf_token;
                        const csrfHash = data.csrf_hash;
                        $(`input[name="${csrfToken}"]`).val(csrfHash);

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
                        console.error(jqXHR);
                        const data = jqXHR.responseJSON;
                        console.error(data);

                        // Update CSRF token
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
                                title: "Error",
                                text: `${jqXHR.responseJSON.message}`,
                                icon: "error"
                            });
                        }
                    },
                    complete: function () {

                        $('#upload-form').find('input, button').prop('disabled', false);

                        // Enable the Select2 dropdown
                        category.prop('disabled', false);
                        category.select2().trigger('change');

                        clearTimeout(uploadProgressInterval); // Clear the interval
                        clearInterval(uploadStatusInterval); // Clear the interval
                    }
                });
            });
        });
    </script>


<?= $this->endSection() ?>