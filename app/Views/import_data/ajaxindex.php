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
        <?= form_open(route_to('sms_service.import_data'), "method='GET' autocomplete='false'") ?>
        <div class="row">
            <!-- category -->
            <div class="form-group col-sm-4">
                <label for="category">Category</label>
                <select name="categories[]" id="category" class="form-control selectTwo" multiple
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

        <?= form_close() ?>
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
            <tbody id="tableBody">
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

<script>


    $(document).ready(function () {
        const table = $('#datatable1').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url("sms_service/import_data/fetch_data/1") ?>',
                type: 'GET'
            },
            columns: [
                {data: 'aggregator.name'},
                {data: 'operator_name'},
                {data: 'form.number'},
                {data: 'to.number'},
                {data: 'date'},
                {data: 'status'},
                {data: 'content'}
            ]
        });

        let currentPage = 1;

        function loadData() {
            console.log('loading data');
            table.ajax.url(`<?= base_url("sms_service/import_data/fetch_data/")?>${currentPage}`).load();
        }

        $('#datatable1_next').click(function () {
            currentPage++;
            table.ajax.url(`<?= base_url("sms_service/import_data/fetch_data/")?>${currentPage}`).load();
        });

        $('#datatable1_previous').click(function () {
            if (currentPage > 1) {
                currentPage--;
                table.ajax.url(`<?= base_url("sms_service/import_data/fetch_data/")?>${currentPage}`).load();
            }
        });

        loadData();
    });

</script>
<?= $this->endSection() ?>
