<?= $this->extend('layout/adminlte3') ?>


<?= $this->section('styles') ?>

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
      href="<?= base_url() ?>adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Operator List</h3>
            </div>
            <?= menu_open(
                route_to('operator_bill.operator.index') . '/test',
                route_to('operator_bill.operator.create'),
            ) ?>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-sm table-striped">
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
            <!-- /.card-body -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
<?= $this->endSection() ?>

