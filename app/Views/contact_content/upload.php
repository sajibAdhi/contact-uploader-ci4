<?= $this->extend('layout/app') ?>

<?= $this->section('styles') ?>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url() ?>bower_components/select2/dist/css/select2.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Contact Content Upload Form</h3>
        </div>
        <form id="upload-form" class="form-horizontal" action="<?= route_to('contact.content.upload') ?>" method="post"
              enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="box-body">
                <div class="progress">
                    <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <!-- Category -->
                <div class="form-group <?= validation_show_error('category') ? 'has-warning' : '' ?>">
                    <label for="category" class="control-label col-sm-3">Select a category:</label>
                    <div class=" col-sm-9">
                        <select class="form-control select2" name="category" id="category" style="width: 100%">
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

                <!-- Category Name -->
                <?= view_cell(\App\Cells\InputFieldCell::class, [
                    'id' => 'categoryName',
                    'name' => 'category_name',
                    'placeholder' => 'Category name'
                ]) ?>

                <?= view_cell(\App\Cells\InputFieldCell::class, [
                    'label' => 'Date',
                    'id' => 'date',
                    'name' => 'date'
                ]) ?>

                <!-- Contacts File -->
                <div class="form-group <?= validation_show_error('contacts_file') ? 'has-warning' : '' ?>">
                    <label for="contacts" class="control-label col-sm-3">Contacts File:</label>
                    <div class=" col-sm-9">
                        <input type="file" class="form-control" name="contacts_file" id="contacts"
                               accept=".csv,.xls,.xlsx" required>
                        <span class="help-block"><?= validation_show_error('contacts_file') ?></span>
                        <p class="help-block">Please upload a CSV or Excel file. The File must contain header
                            <b>MOBILE_NO</b>
                            and <b>SMS_CONTENT</b>.</p>
                    </div>
                </div>

            </div>

            <?= view_cell(\App\Cells\FormSubmitCell::class) ?>
        </form>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <!-- Select2 -->
    <script src="<?= base_url('bower_components/select2/dist/js/select2.full.min.js') ?>"></script>

    <script>
        $(document).ready(function () {

            //Initialize Select2 Elements
            $('.select2').select2()


            function updateProgress() {
                $.ajax({
                    url: '<?= route_to('contact.content.progress')?>',
                    success: function (data) {
                        // Update your progress bar here
                        let progress = data.progress;
                        $('#progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);

                    }
                });
            }

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

                        // Start the interval when the AJAX request starts call updateProgress every 5 second
                        intervalId = setInterval(updateProgress, 2000);
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                            $('#progress-bar').css('width', 100 + '%').attr('aria-valuenow', 100);
                            $('#upload-form').trigger('reset');
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function (jqXHR) {
                        if (jqXHR.status === 422) { // If it's a validation error
                            const errors = jqXHR.responseJSON.errors;
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    toastr.error(errors[key]); // Display each error message
                                }
                            }
                        } else {
                            toastr.error('Something went wrong. Please try again later.');
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