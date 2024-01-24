<?= $this->extend('layout/adminlte3') ?>



<?= $this->section('styles') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<!-- Contact Content Table Box-->
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Operator Bills</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-hover">
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
                <?php

                use App\Cells\AnchorButtonCell;

                if (empty($operatorBills)) : ?>
                    <tr>
                        <td colspan="12" class="text-center">No data found</td>
                    </tr>
                <?php else : ?>
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
                                    <a class="btn btn-info btn-sm" href="<?= base_url("$file->file_path") ?>" title="<?= esc($file->file_name) ?>" download="<?= esc($file->file_name) ?>">
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
    <!-- /.box-body -->
</div>

<?= $this->endSection() ?>



<?= $this->section('scripts') ?>


<?= $this->endSection() ?>