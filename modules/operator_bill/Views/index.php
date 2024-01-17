<?= $this->extend('layout/app') ?>



<?= $this->section('styles') ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('bower_components/select2/dist/css/select2.min.css') ?>">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url() ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet"
      href="<?= base_url() ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<!-- Filter Form Box -->
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Contacts Contents Search</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- Filter Form -->
        <form action="<?= route_to('contact.content.index') ?>" method="GET">
            <div class="row">
                <!-- category -->
                <div class="form-group col-sm-4">
                    <label for="category">Category</label>
                    <select name="categories[]" id="category" class="form-control select2" multiple
                            data-placeholder="Select a Category"
                            style="width: 100%;">
                        <option value="all" <?= set_select('categories', 'all', true) ?> >
                            All
                        </option>
                        <?php if (! empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>" <?= set_select('categories', $category->id) ?>><?= $category->name ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                </div>

                <!-- Date range -->
                <div class="form-group col-sm-4">
                    <label for="daterange">Date range:</label>

                    <div class="input-group daterange">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control " name="daterange"
                               value="<?= set_value('daterange') ?>">
                    </div>
                    <!-- /.input group -->
                </div>

                <!-- limit -->
                <div class="form-group col-sm-4">
                    <label for="limit">Limit</label>
                    <input type="number" name="limit" id="limit" class="form-control"
                           value="<?= set_value('limit') ?>">
                </div>

            </div> <!-- /.row -->

            <?= view_cell(\App\Cells\ButtonCell::class, ['title' => 'Search', 'class' => 'btn-primary pull-right']) ?>

        </form>
        <!-- /.Filter Form -->
    </div>
    <!-- /.box-body -->
</div>

<!-- Contact Content Table Box-->
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Contacts Contents</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <table class="table table-sm table-responsive table-hover table-bordered">
            <thead>
            <tr>
                <th>Contact</th>
                <th>Category</th>
                <th>Date</th>
                <th>Content</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var App\Models\ContactModel[] $contacts */ ?>
            <?php if (empty($contacts)): ?>
                <tr>
                    <td colspan="5" class="text-center">No data found</td>
                </tr>
            <?php else: ?>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact->number ?></td>
                        <td><?= $contact->category_name ?></td>
                        <td><?= $contact->date ?></td>
                        <td><?= $contact->content ?></td>
                        <td><?= $contact->remarks ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php endif; ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Contact</th>
                <th>Category</th>
                <th>Date</th>
                <th>Content</th>
                <th>Remarks</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.box-body -->
</div>

<?= $this->endSection() ?>



<?= $this->section('scripts') ?>
    <!-- Select2 -->
    <script src="<?= base_url('bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
    <!-- bootstrap datepicker -->
    <script src="<?= base_url() ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {

            //Initialize Select2 Elements
            $('.select2').select2()

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            })

            function updateProgress() {
                $.ajax({
                    url: '<?= route_to('contact.content.progress')?>',
                    success: function (data) {
                        // Update your progress bar here
                        let progress = data.progress;
                        // if progress not null
                        if (progress) {
                            progress = Math.round(progress);
                            $('#progress-bar').css('width', progress + '%').attr('aria-valuenow', progress).html(progress + '%');
                        }
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
                        $('#progress-bar').css('width', 0 + '%').attr('aria-valuenow', 0);

                        // Disable the Select2 dropdown
                        category.prop('disabled', true);
                        category.select2().trigger('change');

                        // Start the interval when the AJAX request starts call updateProgress every 1 second
                        intervalId = setInterval(updateProgress, 1000);
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

                        // Fill the progress bar
                        $('#progress-bar').css('width', 100 + '%').attr('aria-valuenow', 100);
                    }
                });


            });
        });
    </script>

<?= $this->endSection() ?>