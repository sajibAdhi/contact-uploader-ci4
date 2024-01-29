<?= $this->extend('layout/app') ?>

<?php helper('datatable'); ?>


<?= $this->section('styles') ?>
    <!-- DataTables -->
<?= load_datatable_styles() ?>

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
                    <!-- Filter data sbu wise, year wise, month wise, operator wise -->
                    <?= form_open(current_url(), "method='get'") ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <select name="sbu" id="sbu" class="form-control select2">
                                <option value="">Select SBU</option>
                                <?php if (!empty($sbuList)): ?>
                                    <?php foreach ($sbuList as $sbu): ?>
                                        <option value="<?= $sbu ?>"><?= strtoupper($sbu) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="month" id="month" class="form-control select2">
                                <option value="">Select Year</option>
                                <?php if (!empty($years)): ?>
                                    <?php foreach ($years as $year): ?>
                                        <option value="<?= $year->year ?>"><?= $year->year ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="month" id="month" class="form-control select2">
                                <option value="">Select Month</option>
                                <?php if (!empty($months)): ?>
                                    <?php foreach ($months as $month): ?>
                                        <option value="<?= $month->month ?>"><?= $month->month ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <select name="operator" id="operator" class="form-control select2">
                                <option value="">Select Operator</option>
                                <?php if (!empty($operators)): ?>
                                    <?php foreach ($operators as $operator): ?>
                                        <option value="<?= $operator->id ?>"><?= $operator->name ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-sm-12 mt-2">
                            <?= view_cell(\App\Cells\ButtonCell::class, ['title' => 'Filter', 'class' => 'btn-info btn-block']) ?>
                        </div>

                    </div>
                    <?= form_close() ?>

                    <hr>

                    <table id="operatorBill" class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>SBU</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Operator</th>
                            <th><span title="Successful Calls">S.C.</span></th>
                            <th><span title="Effective Duration">E.D.</span></th>
                            <th><span title="Voice Amount">V.A.</span></th>
                            <th><span title="Voice Amount with Vat">V.A.V.</span></th>
                            <th><span title="SMS Count">S.C.</span></th>
                            <th><span title="SMS Amount">S.A.</span></th>
                            <th><span title="SMS Amount with Vat">S.A.V.</span></th>
                            <th>Files</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($operatorBills)) : ?>
                            <?php foreach ($operatorBills as $bill) : ?>
                                <tr>
                                    <td><?= strtoupper($bill->sbu) ?></td>
                                    <td><?= $bill->year ?></td>
                                    <td><?= $bill->month ?></td>
                                    <td><?= $bill->operator->name ?? null ?></td>
                                    <td><?= $bill->successful_calls ?></td>
                                    <td><?= $bill->effective_duration ?></td>
                                    <td><?= $bill->voice_amount ?></td>
                                    <td><?= $bill->voice_amount_with_vat ?></td>
                                    <td><?= $bill->sms_count ?></td>
                                    <td><?= $bill->sms_amount ?></td>
                                    <td><?= $bill->sms_amount_with_vat ?></td>
                                    <td>
                                        <?php foreach ($bill->files as $file) : ?>
                                            <a class="btn btn-info btn-sm"
                                               href="<?= base_url("$file->file_path") ?>"
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
                        <tfoot>
                        <tr>
                            <th>SBU</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Operator</th>
                            <th><span title="Successful Calls">S.C.</span></th>
                            <th><span title="Effective Duration">E.D.</span></th>
                            <th><span title="Voice Amount">V.A.</span></th>
                            <th><span title="Voice Amount with Vat">V.A.V.</span></th>
                            <th><span title="SMS Count">S.C.</span></th>
                            <th><span title="SMS Amount">S.A.</span></th>
                            <th><span title="SMS Amount with Vat">S.A.V.</span></th>
                            <th>Files</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

<?= $this->endSection() ?>



<?= $this->section('scripts') ?>

    <!-- DataTables -->
<?= load_datatable_scripts() ?>

    <!-- Page specific script -->
<?= initialize_datatable('operatorBill') ?>

<?= $this->endSection() ?>