<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<!-- Category Create Section -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= ($action ?? null) === 'edit' ? 'Edit' : 'Create' ?> Aggregator</h3>
    </div>
    <form class="form-horizontal"
          action="<?= ($action ?? null) === 'edit'
              ? route_to('aggregator.edit', ($aggregator->id ?? null))
              : route_to('aggregator.store') ?>"
          method="post">
        <?= csrf_field() ?>
        <?php if (($action ?? null) === 'edit'): ?>
            <?= form_hidden('_method', 'PUT') ?>
        <?php endif; ?>

        <div class="box-body">
            <!-- aggregator -->
            <div class="form-group <?= validation_show_error('aggregator') ? 'has-warning' : '' ?>">
                <label for="aggregator" class="control-label col-sm-3">
                    Aggregator: <span class="text-danger">*</span>
                </label>
                <div class=" col-sm-9">
                    <input type="text" class="form-control col-sm-9" name="aggregator" id="aggregator"
                           value="<?= set_value('aggregator', $aggregator->name ?? null) ?>" placeholder="Aggregator Name"
                           required>
                    <span class="help-block"><?= validation_show_error('aggregator') ?></span>
                </div>
            </div>
        </div>

        <?= view_cell(\App\Cells\FormSubmitCell::class, [
            'title' => ($action ?? null) === 'edit' ? 'Update' : 'Submit',
        ], 300) ?>
    </form>
</div>

<!-- Categories List Section -->
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Categories</h3>
    </div>
    <div class="box-body">
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Aggregator Name</th>
                <th style="width: 50Px">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var App\Models\AggregatorModel[] $aggregators */ ?>
            <?php if (!empty($aggregators)): ?>
                <?php foreach ($aggregators as $index => $aggregator): ?>
                    <tr>
                        <td><?= $aggregator->id ?></td>
                        <td><?= $aggregator->name ?></td>
                        <td>
                            <?= view_cell('AnchorButtonCell::edit', ['href' => route_to('aggregator.edit', $aggregator->id)]) ?>
                            <!--                            --><?php // = view_cell('FormDeleteButtonCell', ['action' => route_to('aggregator.delete', $aggregator->id)])?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No Aggregator Found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

<?= $this->endSection() ?>
