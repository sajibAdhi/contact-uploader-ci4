<?= $this->extend('layout/app') ?>
<?php helper('datatable'); ?>


<?= $this->section('pageStyles') ?>
<?= load_datatable_styles() ?>
<?= $this->endSection() ?>

<?php $this->section('pageScripts') ?>
<?= load_datatable_scripts() ?>
<?= initialize_datatable('operators') ?>
<?= $this->endSection() ?>


<?= $this->section('main') ?>

<!-- Contact Content Table Box -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Operators</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="operators" class="table table-sm table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th data-width="20px">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($operators)): ?>
                        <tr>
                            <td colspan="5" class="text-center">No operators found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($operators as $operator): ?>
                            <tr>
                                <td><?= esc($operator->name) ?></td>
                                <td><?= strtoupper(esc($operator->type)) ?></td>
                                <td><?= esc($operator->address) ?></td>
                                <td><?= esc($operator->phone) ?></td>
                                <td><?= esc($operator->email) ?></td>
                                <td>
                                    <?= view_cell('AnchorButtonCell::edit', ['href' => route_to('operator_bill.operator.edit', $operator->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<?= $this->endSection() ?>
