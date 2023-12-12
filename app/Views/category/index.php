<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<!-- Category Create Section -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= ($action ?? null) == 'edit' ? 'Edit Category' : 'Create Category' ?></h3>
    </div>
    <form class="form-horizontal"
          action="<?= ($action ?? null) == 'edit'
              ? route_to('category.edit', ($category->id ?? null))
              : route_to('category.store') ?>"
          method="post"
          enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="box-body">
            <!-- Category -->
            <div class="form-group <?= validation_show_error('category') ? 'has-warning' : '' ?>">
                <label for="category" class="control-label col-sm-3">
                    Category: <span class="text-danger">*</span>
                </label>
                <div class=" col-sm-9">
                    <input type="text" class="form-control col-sm-9" name="category" id="category"
                           value="<?= set_value('category', $category->name ?? null) ?>" placeholder="Category Name"
                           required>
                    <span class="help-block"><?= validation_show_error('category') ?></span>
                </div>
            </div>
        </div>

        <?= view_cell('FormSubmitCell', [
            'title' => ($action ?? null) == 'edit' ? 'Update' : 'Submit',
        ], 300) ?>
    </form>
</div>

<!-- Categories List Section -->
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Categories</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped dataTable">
            <thead>
            <tr>
                <th>SL NO</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var \App\Models\Category[] $categories */ ?>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $index => $category): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $category->name ?></td>
                        <td>
                            <a class="btn btn-sm" href="<?= route_to('category.edit', $category->id) ?>">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a class="btn btn-sm" href="<?= route_to('category.delete', $category->id) ?>">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

<?= $this->endSection() ?>
