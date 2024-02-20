<?= $this->extend('layout/adminlte2') ?>

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
        <?php /* @var object $pager */ ?>
        <?= $pager->links('default', 'bootstrap4') ?>
    </div>
    <!-- /.box-body -->
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- date-range-picker -->
<script src="<?= base_url() ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
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
