<?= $this->extend('layout/app') ?>

<?= $this->section('pageStyles') ?>
<?= load_datatable_styles() ?>
<?= load_datepicker_styles() ?>
<?= load_select2_styles() ?>
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
        <form action="<?= base_url(route_to('sms_service.import_data')) ?>">
            <div class="row">
                <!-- category -->
                <div class="form-group col-sm-4">
                    <label for="category">Category</label>
                    <select name="to_contact_categories[]" id="to_contact_categories" class="form-control selectTwo"
                            multiple
                            data-placeholder="Select a Category"
                            style="width: 100%;">
                        <option value="all" <?= set_select('to_contact_categories', 'all', true) ?> >
                            All
                        </option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>" <?= set_select('to_contact_categories', $category->id) ?>><?= $category->name ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                </div>

                <!-- Date range -->
                <div class="form-group col-sm-4">
                    <label for="daterange">Date range:</label>

                    <div class="input-group date-range">
                        <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                        </div>
                        <input type="text" class="form-control float-right" name="daterange"
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
                <th>ToCategory</th>
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
                        <td><?= $contactContent->aggregator_name ?></td>
                        <td><?= $contactContent->operator_name ?></td>
                        <td><?= $contactContent->from_number ?></td>
                        <td><?= $contactContent->to_number ?></td>
                        <td><?= $contactContent->to_number_category ?></td>
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
<?= load_datepicker_scripts() ?>
<?= load_select2_scripts() ?>

<?= initialize_select2('.selectTwo') ?>

<?php //= initialize_datepicker('.date-range',[
//
//]) ?>

<script>
    $(document).ready(function () {

        //Date range picker
        const daterange = $('.date-range');
        daterange.daterangepicker();

        // daterange.on('apply.daterangepicker', function (ev, picker) {
        //     $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        // });
    });
</script>
<?= $this->endSection() ?>
