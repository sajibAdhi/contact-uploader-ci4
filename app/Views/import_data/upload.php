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
                    <div class="progress">
                        <div id="progress-bar" class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
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
            const uploadForm = $('#upload-form');

            // Submit the form using AJAX
            uploadForm.submit(function (event) {
                event.preventDefault();
                let formData = new FormData(this);

                // stop interacting with the form
                $(this).find('input, button, select').prop('disabled', true);


                uploadFile(formData).then((response) => {

                    if (response.csrf_token && response.csrf_hash) {
                        // update the csrf token
                        $(`input[name="${response.csrf_token}"]`).val(response.csrf_hash);
                        // update the csrf token in the form
                        formData.append(response.csrf_token, response.csrf_hash);
                    }

                    if (response.success) {
                        $(document).Toasts('create', {
                            class: 'bg-success',
                            title: 'Notification',
                            body: `${response.success}!`
                        })

                        let batch = response.batch;
                        formData.append('batch', batch);
                        // Start the progress bar
                        uploadProgressInterval = setInterval(() => testProgress(batch), 1000);

                        return storeData(formData);
                    }

                    return response;
                }).then((response) => {

                    if (response.success) {
                        if (response.csrf_token && response.csrf_hash) {
                            // update the csrf token
                            $(`input[name="${response.csrf_token}"]`).val(response.csrf_hash);
                            // update the csrf token in the form
                            formData.append(response.csrf_token, response.csrf_hash);
                        }

                        $(document).Toasts('create', {
                            class: 'bg-success',
                            title: 'Notification',
                            body: `${response.success}!`
                        })
                        // enable form
                        uploadForm.find('input, button, select').prop('disabled', false);
                    }
                    $(this).find('input, button, select').prop('disabled', false);
                }).fail((error) => {
                    let response = error.responseJSON;

                    if (response.csrf_token && response.csrf_hash) {
                        // update the csrf token
                        $(`input[name="${response.csrf_token}"]`).val(response.csrf_hash);
                        // update the csrf token in the form
                        formData.append(response.csrf_token, response.csrf_hash);
                    }

                    if (response.error) {
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: 'Alert!',
                            body: `${response.error}!`
                        });
                    } else if (response.errors) {
                        let errors = response.errors;
                        for (let key in errors) {
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Alert!',
                                body: `${errors[key]}`
                            });
                        }

                    }
                    $(this).find('input, button, select').prop('disabled', false);

                });

            });

            // upload file
            function uploadFile(formData) {
                return $.ajax({
                    url: '<?= route_to('sms_service.import_data.upload_file')?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }

            // store data
            function storeData(formData) {
                return $.ajax({
                    url: '<?= route_to('sms_service.import_data.store_data')?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }

            // Update the progress bar
            function testProgress(batch) {
                $.ajax({
                    url: `<?= route_to('sms_service.import_data.progress')?>`,
                    type: 'GET',
                    data: {batch: batch},
                    success: function (response) {
                        // Update your progress bar here
                        const stored = response.stored;
                        const count = response.count;
                        const inserted = response.inserted;
                        const progress = response.progress;

                        if (stored === true) {
                            if (inserted === count) {
                                $(document).Toasts('create', {
                                    class: 'bg-success',
                                    title: 'Notification',
                                    body: `Data has been successfully stored!`
                                });
                            } else if (progress === 0) {
                                $(document).Toasts('create', {
                                    class: 'bg-warning',
                                    title: 'Notification',
                                    body: `No unique data to store!`
                                });
                            } else if (inserted > 0 && inserted < count) {
                                $(document).Toasts('create', {
                                    class: 'bg-warning',
                                    title: 'Notification',
                                    body: `Some data has been stored!`
                                });
                            }
                            clearInterval(uploadProgressInterval);
                        }
                        // progress bar with inserted count
                        $('#progress-bar').css('width', `${progress}%`).attr('aria-valuenow', progress).html(`${inserted}/${count}`);
                    }
                });
            }
        });
    </script>


<?= $this->endSection() ?>