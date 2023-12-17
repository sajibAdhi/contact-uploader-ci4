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
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Contacts Contents</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- Filter Form -->
        <form action="<?= route_to('contact.content.index') ?>" method="get">
            <div class="row">

                <!-- category -->
                <div class="form-group col-sm-4">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control select2" multiple="multiple"
                            data-placeholder="Select a Category"
                            style="width: 100%;">
                        <option value="all" <?= set_select('category', 'all', 'all') ?>>All</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>" <?= set_select('category', $category->id) ?>><?= $category->name ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                </div>

                <!-- Date range -->
                <div class="form-group col-sm-4">
                    <label for="daterange">Date range:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control " id="daterange" name="daterange">
                    </div>
                    <!-- /.input group -->
                </div>

                <!-- limit -->
                <div class="form-group col-sm-4">
                    <label for="limit">Limit</label>
                    <input type="number" name="limit" id="limit" class="form-control">
                </div>

            </div> <!-- /.row -->

            <?= view_cell('ButtonCell', ['title' => 'Search', 'class' => 'btn-primary pull-right']) ?>
        </form>
        <!-- /.Filter Form -->

        <table class="table table-bordered table-striped dataTable">
            <thead>
            <tr>
                <th>Contact</th>
                <th>Category</th>
                <th>Content</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var \App\Models\Contact[] $contacts */ ?>
            <?php if (empty($contacts)): ?>
                <tr>
                    <td colspan="3" class="text-center">No contacts found</td>
                </tr>
            <?php else: ?>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact->number ?></td>
                        <td><?= $contact->category_name ?></td>
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
                <th>Content</th>
                <th>Remarks</th>
            </tr>
            </tfoot>

        </table>
        <?= $pager->links('default', 'bootstrap4') ?>
    </div>
    <!-- /.box-body -->
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- DataTables -->
<script src="<?= base_url('bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<!-- date-range-picker -->
<script src="<?= base_url() ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<!--<script src="--><?php //= base_url() ?><!--bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>-->

<!-- Select2 -->
<script src="<?= base_url('bower_components/select2/dist/js/select2.full.min.js') ?>"></script>


<script>
    <!-- On document ready call select2 -->
    $(document).ready(function () {

        // Initialize select2 with multiple select
        $('.select2').select2({});

        //Date range picker
        $('#daterange').daterangepicker()
    });
</script>
<?= $this->endSection() ?>
