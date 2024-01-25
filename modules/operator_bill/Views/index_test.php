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
                    <h3 class="card-title">Operator Bills</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Operator</th>
                            <th>Successful Calls</th>
                            <th>Effective Duration</th>
                            <th>Voice Amount</th>
                            <th>Voice Amount with VAT</th>
                            <th>SMS Count</th>
                            <th>SMS Rate</th>
                            <th>SMS Amount</th>
                            <th>SMS Amount with VAT</th>
                            <th>Files</th>
                            <!-- <th>Action</th> -->

                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($operatorBills)) : ?>
                            <?php foreach ($operatorBills as $bill) : ?>
                                <tr>
                                    <td><?= $bill->year ?></td>
                                    <td><?= $bill->month ?></td>
                                    <td><?= $bill->operator->name ?? null ?></td>
                                    <td><?= $bill->successful_calls ?></td>
                                    <td><?= $bill->effective_duration ?></td>
                                    <td><?= $bill->voice_amount ?></td>
                                    <td><?= $bill->voice_amount_with_vat ?></td>
                                    <td><?= $bill->sms_count ?></td>
                                    <td><?= $bill->sms_rate ?></td>
                                    <td><?= $bill->sms_amount ?></td>
                                    <td><?= $bill->sms_amount_with_vat ?></td>
                                    <td>
                                        <?php foreach ($bill->files as $file) : ?>
                                            <a class="btn btn-info btn-sm" href="<?= base_url("$file->file_path") ?>"
                                               title="<?= esc($file->file_name) ?>"
                                               download="<?= esc($file->file_name) ?>">
                                                <i class="fa fa-file"></i>
                                            </a>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <?= view_cell('AnchorButtonCell::edit', ['href' => route_to('operator_bill.edit', $bill->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
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