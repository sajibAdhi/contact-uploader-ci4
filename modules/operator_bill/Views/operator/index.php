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
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($operators as $operator): ?>
                <tr>
                    <td><?= $operator->name ?></td>
                    <td><?= $operator->address ?></td>
                    <td><?= $operator->phone ?></td>
                    <td><?= $operator->email ?></td>
                    <td>
                        <?= view_cell('AnchorButtonCell::edit', ['href' => route_to('operator_bill.operator.edit', $operator->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
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

