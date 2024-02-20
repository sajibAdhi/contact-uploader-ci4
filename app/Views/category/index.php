<?= $this->extend('layout/app') ?>


<?= $this->section('pageStyles') ?>
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


<?= $this->section('main') ?>

<!-- Category Create Section -->
<div class="card card-primary">
    <div class="card-header with-border">
        <h3 class="card-title"><?= ($action ?? null) === 'edit' ? 'Edit Category' : 'Create Category' ?></h3>
    </div>
    <?= form_open(
        ($action ?? null) === 'edit'
            ? route_to('sms_service.category.edit', ($category->id ?? null))
            : route_to('sms_service.category.store'),
    ) ?>

    <?php if (($action ?? null) === 'edit'): ?>
        <?= form_hidden('_method', 'PUT') ?>
    <?php endif; ?>

    <div class="card-body">
        <!-- Category -->
        <div class="form-group row <?= validation_show_error('category') ? 'has-warning' : '' ?>">
            <label for="category" class="control-label col-sm-3">
                Category: <span class="text-danger">*</span>
            </label>
            <div class=" col-sm-9">
                <input type="text" class="form-control" name="category" id="category"
                       value="<?= set_value('category', $category->name ?? null) ?>" placeholder="Category Name"
                       required>
                <span class="help-block"><?= validation_show_error('category') ?></span>
            </div>
        </div>
    </div>

    <?= view_cell(\App\Cells\FormSubmitCell::class, [
        'title' => ($action ?? null) === 'edit' ? 'Update' : 'Submit',
    ], 300) ?>

    <?= form_close() ?>
</div>

<!-- Categories List Section -->
<div class="card card-info">
    <div class="card-header with-border">
        <h3 class="card-title">Categories</h3>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>SL NO</th>
                <th>Category Name</th>
                <th style="width: 50Px">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var App\Models\CategoryModel[] $categories */ ?>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $index => $category): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $category->name ?></td>
                        <td>
                            <?= view_cell('ActionButtonCell::edit', ['href' => route_to('sms_service.category.edit', $category->id)]) ?>
                            <!--                            --><?php // = view_cell('FormDeleteButtonCell', ['action' => route_to('category.delete', $category->id)])?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No Category Found</td>
                </tr>
            <?php endif; ?>
            </tbody>
            <tfoot>
            <tr>
                <th>SL NO</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>

    </div>
</div>

<?= $this->endSection() ?>
