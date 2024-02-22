<?= $this->extend('layout/app') ?>

<?php helper('adminlte3'); ?>
<?= $this->section('pageStyles') ?>
<?= load_datatable_styles() ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('bower_components/select2/dist/css/select2.min.css') ?>">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url() ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet"
      href="<?= base_url() ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<?= $this->endSection() ?>

<?= $this->section('main') ?>
<!-- Filter Form card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Search</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- Filter Form -->
        <form action="<?= route_to('sms_service.import_data') ?>" method="GET">
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
                        <?php if (!empty($categories)): ?>
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
    <!-- /.card-body -->
</div>

<!-- Contact Content Table card-->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Contacts Contents</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <table id="datatable1" class="table table-sm table-hover table-bordered">
            <thead>
            <tr>
                <th>Aggregator</th>
                <th>Operator</th>
                <th>Form</th>
                <th>To</th>
                <th>Date</th>
                <th>Status</th>
                <th>Content</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var App\Models\ContactContentModel[] $contacts */ ?>
            <?php if (empty($contactContents)): ?>
                <tr>
                    <td colspan="7" class="text-center">No data found</td>
                </tr>
            <?php else: ?>
                <?php foreach ($contactContents as $contactContent): ?>
                    <tr>
                        <td><?= $contactContent->aggregator->name ?></td>
                        <td><?= $contactContent->operator_name ?></td>
                        <td><?= $contactContent->form->number ?></td>
                        <td><?= $contactContent->to->number ?></td>
                        <td><?= $contactContent->date ?></td>
                        <td><?= $contactContent->status ?></td>
                        <td><?= $contactContent->content ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Aggregator</th>
                <th>Operator</th>
                <th>Form</th>
                <th>To</th>
                <th>Date</th>
                <th>Status</th>
                <th>Content</th>
            </tr>
            </tfoot>
        </table>
        <?php /* @var object $pager */ ?>
        <?= $pager->links('default', 'bootstrap4') ?>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<?= load_datatable_scripts() ?>
<?= initialize_datatable('datatable1') ?>

<!-- bootstrap datepicker -->
<!--<script src="--><?php // = base_url()?><!--bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>-->

<!-- Select2 -->
<script src="<?= base_url('bower_components/select2/dist/js/select2.full.min.js') ?>"></script>


<script>
    <!-- On document ready call select2 -->
    $(document).ready(function () {

        // Initialize select2 with multiple select
        $('.select2').select2();

        //Date range picker
        const daterange = $('.daterange');
        daterange.daterangepicker({
            autoUpdateInput: false
        });

        daterange.on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });
    });
</script>
<?= $this->endSection() ?>
